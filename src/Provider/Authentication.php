<?php

namespace App\Provider;

use App\Model\Login;
use App\Providers\Logging;
use App\Providers\Session;
use Cake\Chronos\Chronos;
use Carbon\Carbon;
use Noodlehaus\Config;

class Authentication
{
    public static function insertLogin($params = array()) {        
        return Login::insert($params);                
    }

    public static function verifyLogin($email) {
        return Login::whereEmail($email)->count();
    }

    public static function findLogin($email) {
        return Login::whereEmail($email)->first();
    }

    public static function updateLogin($email, $fields = array()) {
        return Login::whereEmail($email)->update($fields);
    }

    public static function deleteLogin($email) {
        return Login::whereEmail($email)->delete();
    }
    
    public static function deleteLoginToken($token) {
        return Login_Token::whereToken($token)->delete();
    }

    public static function insertLoginToken($params = array()) {
        return Login_Token::insert($params);       
    }

    public static function insertPasswordToken($params = array()) {
        return Password_Token::insert($params);
    }

    public static function deletePasswordTokenSerial($serial) {
        return Password_Token::whereSerial($serial)->delete();
    }

    public static function getLoginTokenSerial($token, $field) {
        return Login_Token::whereToken($token)->pluck($field);
    }

    public static function getPasswordTokenSerial($token, $field) {
        return Password_Token::whereToken($token)->pluck($field);
    }

    public static function getPasswordToken($token) {
        return Password_Token::whereToken($token)->first();
    }

    public static function deleteLoginTokenSerial($serial) {
        return Login_Token::whereSerial($serial)->delete();
    }

    public static function deleteAll($email, $serial, $token) {
        self::deleteLogin($email);
        self::deleteLoginTokenSerial($serial);
        self::deleteLoginToken($token);        
    }

    public static function orwhereEmail($email, $field, $operator, $value) {
        return Login::whereEmail($email)->orWhere($field, $operator, $value)->count();
    }

    public static function login($email = NULL, $senha = NULL) {
        $config = new Config(\dirname(__DIR__) . '/../config');
        $ip = new Remote();          
        $proxy = $ip->getIpAddress();       
        $dataacesso = Chronos::now()->timezone('America/Sao_Paulo')->toDateString();
        $horaacesso = Chronos::now()->timezone('America/Sao_Paulo')->toTimeString();
        $stmt = self::findLogin($email);
        if (!$stmt) {
            return false;
        }
        if ($stmt) {
            if (password_verify($senha, $stmt->senha)) {
                self::updateLogin($email, array('ip' => $proxy, 'horaacesso' => $horaacesso, 'dataacesso' => $dataacesso));
                $fechado = self::orwhereEmail($email, 'ativo', '=', 'N');
                if ($fechado == 1) {
                    self::updateLogin($email, array('ativo' => 'Y'));
                }
                Session::setSession('login', $stmt->login);                        
                $token = Hash::generateHash(Hash::setKey(32));
                Logging::info("Login: " . Carbon::parse(Carbon::now())->setTimezone('America/Sao_Paulo')->locale('pt_BR')->settings(['formatFunction' => 'isoFormat'])->format('LLLL') . ";" . " Nome do Usuário: " . Session::getSession('login') . ";" . " URL acessada: '/signin'");
                //self::insertLoginToken(array('serial' => $stmt->id, 'token' => $token, 'ipacesso' => $proxy));
                Cookie::setCookieValue('SNID', $token, $config->get('cookie.main'));
                Cookie::setCookieValue('SNID_', '1', $config->get('cookie.aux'));
                return true;
            }
        }
        return false;
    }

    public static function logout() {       
        Logging::info("Logout: " . Carbon::parse(Carbon::now())->setTimezone('America/Sao_Paulo')->locale('pt_BR')->settings(['formatFunction' => 'isoFormat'])->format('LLLL') . ";" . " Nome do Usuário: " . Session::getSession('login') . ";" . " URL acessada: '/logout'");
        Logging::alert("Token de identificação do logout: " . Session::getSession('usertoken'));*/
        if (hash_equals(Session::getSession('usertoken'), Input::str('token'))) {
            Session::deleteSession('usertoken');            
            if (Cookie::hasCookie('SNID')) {
                //self::deleteLoginTokenSerial(self::isLoggedIn());
            }
            Cookie::deleteCookie('SNID');
            Cookie::deleteCookie('SNID_');
            //Redirect::goTo('home');
        }
    }

    public static function isLoggedIn() {          
        $config = new Config(\dirname(__DIR__) . '/../config');
        if (Cookie::hasCookie('SNID')) {
            if (self::getLoginTokenSerial(Cookie::getCookie('SNID'), 'serial')) {
                $serial = self::getLoginTokenSerial(Cookie::getCookie('SNID'), 'serial');
                if (Cookie::hasCookie('SNID_')) {
                    return $serial;
                } else {                   
                    $token = Hash::generateHash(Hash::setKey(32));
                    self::insertLoginToken([
                        'serial' => $serial,
                        'token' => $token,
                    ]);
                    self::deleteLoginToken(Cookie::getCookie('SNID'));
                    Cookie::setCookieValue('SNID', $token, $config->get('cookie.main'));
                    Cookie::setCookieValue('SNID_', '1', $config->get('cookie.aux'));
                    return $serial;
                }
            }
        }
        return false;
    }
}   