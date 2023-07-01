<?php

// パスワードを記録した場所
echo __FILE__;

// パスワードの暗号化
echo '<br>';

echo (password_hash('password123', PASSWORD_BCRYPT));
