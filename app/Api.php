<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery\CountValidator\Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\GuzzleException;
use Cache;

class Api
{
    protected $client;

    public function __construct(){

        $this->appId = config('api.appId');
        $this->appCode = config('api.appCode');
        $this->appSecret = config('api.appSecret');
        $this->base_uri = config('api.url');
        $this->group_id = config('api.group_id');

        $this->client = new Client(['base_uri' => $this->base_uri]);
    }

    protected function result(Response &$response){

        if($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody(), true);
            $error = [
                'code'=> 0,
                'message' => ''
            ];
        } else {
            $result = [];
            $error = [
                'code' => $response->getStatusCode(),
                'message' => $response->getBody()
            ];
        }

        $result['http_error'] = $error;

        return $result;
    }

    protected function request($method, $uri='', $data=NULL, $cache=true) {
        if (!is_array($data)){
            $data = [];
        }

        $key = 'api_request_'.md5($uri).'_'.md5(serialize($data));
        if ($cache && ($method=='GET' && Cache::has($key))){
            $result = unserialize(Cache::get($key));
        } else {
            $options = [
                'headers' => [
                    'USER-NAME' => 'XTP',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'body' => json_encode($data)
            ];
            $options['timeout'] = 1.0;
            $options['connect_timeout'] = 1.0;

            try {
                $response = $this->client->request($method, $uri, $options);
            } catch (ClientException $e) {
                return ['http_error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ]];
            } catch (ServerException $e) {
                return ['http_error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ]];
            } catch (GuzzleException $e) {
                return ['http_error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ]];
            }

            $result = $this->result($response);

            Cache::put($key, serialize($result), 10+rand(1,20));
        }

        return $result;
    }

    public function groups($query=[]) {
        $query['subType'] = 3;
        $result = $this->request('GET', 'groups/?'.http_build_query($query));
        return $result;
    }

    public function group($id) {
        $result = $this->request('GET', 'groups/'.$id.'/profile');
        if ($result['http_error']['code'] == 0) {
            if (!empty($result['properties'])) {
                $properties = $result['properties'];
                unset($result['properties']);
                if (is_array($properties['items'])) {
                    foreach ($properties['items'] as $item) {
                        $result[$item['groupKey']] = $item['groupValue'];
                    }
                }
            }
        }

        return $result;
    }

    public function permissions($query=[]) {
        $query['applicationId'] = $this->appId;
        $result = $this->request('GET', 'permissions/?'.http_build_query($query));
        return $result;
    }

    public function permission_create($permission) {
        $permission['applicationId'] = $this->appId;
        $result = $this->request('POST', 'permissions', $permission);
        return $result;
    }

    public function permission_delete($permission_id) {
        $result = $this->request('DELETE', 'permissions/'.$permission_id);
        return $result;
    }


    public function applications_users($query=[]) {
        $query['applicationCode'] = $this->appCode;
        $result = $this->request('GET', 'applications/users/?'.http_build_query($query));
        return $result;
    }

    public function users($query=[]) {
        $query['applicationCode'] = $this->appCode;
        $result = $this->request('GET', 'users/?'.http_build_query($query));
        return $result;
    }

    public function user($id, $cache=true) {
        if (empty($id)){
            $id = '0';
        }
        $user = $this->request('GET', 'users/'.$id);
        if (!is_array($user)){
            $user = [];
        }

        $user['permissions'] = $this->user_permissions($id, [], $cache);
        if (!empty($user['orgs'])) {
            $user['group'] = $this->group($user['orgs']);//;
        } else {
            $user['group'] = [];
        }

        return $user;
    }


    public function user_by_name($username, $cache=true) {
        $users = $this->request('GET', 'users/?userName='.$username);
        var_dump($users);
        if (is_array($users) && is_array($users['items'])){
            foreach ($users['items'] as $item){
                if ($item['userName'] == $username){
                    $user = $item;
                    break;
                }
            }
        }

        if (empty($user)){
            return null;
        }

        $user['permissions'] = $this->user_permissions($user['id'], [], $cache);
        if (!empty($user['orgs'])) {
            $user['group'] = $this->group($user['orgs']);//;
        } else {
            $user['group'] = [];
        }

        return $user;
    }

    public function user_permissions($user_id, Array $query=[], $cache=true) {
        $key = 'api_user_permissions_'.$user_id.'_'.join('_',$query);
        if ($cache && Cache::has($key))
        {
            $result = unserialize(Cache::get($key));
        } else {
            $query['applicationId'] = $this->appId;
            $result = $this->request('GET', 'users/' . $user_id . '/permissions/?' . http_build_query($query), null, $cache);


            if (isset($result['items'])){
                $result_ = $result['items'];
                $result = [];
                foreach ($result_ as $item){
                    if ($item['applicationId'] == $this->appId){
                        $result[] = $item;
                    }
                }
            } else {
                $result = [];
            }

            Cache::put($key, serialize($result), 10);
        }

        return $result;
    }

    public function user_permission_create($user_id, $permission_id) {
        $result = $this->request('POST', 'users/'.$user_id.'/permissions/'.$permission_id);
        return $result;
    }

    public function user_permission_delete($user_id, $permission_id) {
        $result = $this->request('DELETE', 'users/'.$user_id.'/permissions/'.$permission_id);
        return $result;
    }



}
