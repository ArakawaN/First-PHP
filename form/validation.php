<?php

function validation($req)
{
    $errors = [];
    if (empty($req['yourName']) || 20 > mb_strlen($req['yourName'])) {
        $errors[] = '氏名は必須です。20文字以内で入力してください。 ';
    }

    if (empty($req['contact']) || 200 > mb_strlen($req['contact'])) {
        $errors[] = 'お問い合わせ内容は必須です。200文字以内で入力してください。 ';
    }

    if (empty($req['email']) || !filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'メールアドレスは必須です。正しい形式で入力してください。';
    }

    if (!empty($req['url'])) {
        if (!filter_var($req['url'], FILTER_VALIDATE_URL)) {
            $errors[] = 'ホームページは正しい形式で入力してください。';
        }
    }

    if (empty($req['caution'])) {
        $errors[] = '注意事項をご確認してください.';
    }

    if (isset($req['gender'])) {
        $errors[] = '性別は必須です。';
    }

    if (empty($req['age']) ||  $req['age'] > 7) {
        $errors[] = '年齢は必須です。';
    }

    return $errors;
}
