<?php
class PasswordHash
{
  public function create_hash($password)
  {
    return password_hash($password, PASSWORD_BCRYPT);
  }

  public function verify_password($password, $hashed_password)
  {
    return password_verify($password, $hashed_password);
  }
}
