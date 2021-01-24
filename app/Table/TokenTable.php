<?php

namespace App\Table;

use Core\Table\Table;

class TokenTable extends Table {
    
    protected $table = 'tokens';

    /**
     * SELECT query
     *
     * @param string $email
     * @return boolean
     */
    public function selectTokenByEmail($email) {
        return $this->query("SELECT * FROM tokens WHERE email = :email",
        ['email' => $email],
        true);
    }

    /**
     * SELECT query for URL generated in e-mail
     *
     * @param string $key
     * @param string $email
     * @return boolean
     */
    public function selectTokenForURL($key, $email) {
        return $this->query("SELECT * FROM tokens WHERE token = '" . $key . "' AND email = '" . $email . "';",
        [
            'key' => $key,
            'email' => $email
        ],
        true);
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertToken(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            email,
            token,
            expiration
        ) VALUES (
            :email,
            :token,
            :expiration
        )",
        [
            'email' => $data['email'],
            'token' => $data['token'],
            'expiration' => $data['expiration']
        ],
        true);
    }

    /**
     * UPDATE query
     *
     * @param string $email
     * @param array $data
     * @return object
     */
    public function updateToken(string $email, array $data) {
        return $this->query("UPDATE {$this->table} SET
            token = :token,
            expiration = :expiration
        WHERE email = :email",
        [
            'email' => $email,
            'token' => $data['token'],
            'expiration' => $data['expiration']
        ],
        true);
    }

    /**
     * DELETE query
     *
     * @param string $email
     * @return object
     */
    public function deleteToken(string $email) {
        return $this->query("DELETE FROM {$this->table} WHERE email = :email",
        ['email' => $email],
        true);
    }

}
