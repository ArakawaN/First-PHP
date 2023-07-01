<?php

session_start();

require 'validation.php';

header('X-FRAME-OPTIONS:DENY');
// スーパーグローブ変数
if (!empty($_POST)) {
    echo '<pre>';
    var_dump($_POST);
    echo '<pre>';
}

$pageFlag = 0;

$errors = validation($_POST);


if (!empty($_POST["btn-confirm"]) && empty($errors)) {
    var_dump($_POST["btn-confirm"]);
    $pageFlag = 1;
}

if (!empty($_POST["btn-submit"])) {
    var_dump($_POST["btn-submit"]);
    $pageFlag = 2;
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if ($pageFlag === 0) : ?>

        <?php
        if (!isset($_SESSION['csrfToken'])) {
            $csrfToken = bin2hex(random_bytes(32));
            $_SESSION['csrfToken'] = $csrfToken;
        }
        $token = $_SESSION['csrfToken'];
        ?>

        <?php
        if (!empty($errors) && !empty($_POST["btn-confirm"])) : ?>

            <?php echo '<ul>' ?>

            <?php
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            ?>

            <?php echo '</ul>' ?>

        <?php endif ?>

        <h1>入力画面</h1>
        <form method="POST" action="input.php">
            <div>
                <h3>氏名</h3>
                <input type="text" name="yourName" value=" <?php if (!empty($_POST['yourName'])) {
                                                                echo h($_POST['yourName']);
                                                            } ?>">
            </div>
            <div>
                <h3>メールアドレス</h3>
                <input type="text" name="email" value=" <?php if (!empty($_POST['email'])) {
                                                            echo h($_POST['email']);
                                                        } ?>">
            </div>
            <div>
                <h3>ホームページ</h3>
                <input type="text" name="url" value=" <?php if (!empty($_POST['url'])) {
                                                            echo h($_POST['url']);
                                                        } ?>">
            </div>
            <div>
                <h3>性別</h3>
                <input type="radio" name="gender" value="0" <?php if (!empty($_POST['gender']) && $_POST['gender'] === '0') {
                                                                echo 'checked';
                                                            } ?>>男性
                <input type="radio" name="gender" value="1" <?php if (!empty($_POST['gender']) && $_POST['gender'] === '1') {
                                                                echo 'checked';
                                                            } ?>>女性
            </div>
            <div>
                <h3>年齢</h3>
                <select name="age">
                    <option value="">以下より選択してください</option>
                    <option value="0">~19歳</option>
                    <option value="1">20~29歳</option>
                    <option value="2">30~39歳</option>
                    <option value="3">40~49歳</option>
                    <option value="4">50~59歳</option>
                    <option value="5">60~69歳</option>
                    <option value="6">70歳~</option>
                </select>
            </div>
            <div>
                <h3>お問い合わせ</h3>
                <textarea name="contact" rows="5" cols="40" <?php if (!empty($_POST['contact'])) {
                                                                echo h($_POST['contact']);
                                                            } ?>"> ></textarea>
            </div>
            <div>
                <input type="checkbox" name="caution" value="1">注意事項のチェック
            </div>

            <button name="btn-confirm" value="送信する">送信する</button>
            <input type="hidden" name="csrf" value="<?php echo $token; ?>" />
        </form>

    <?php endif; ?>

    <?php
    if ($pageFlag === 1) : ?>

        <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>



            確認画面

            <form method="POST" action="input.php">

                <!-- <div>
                <p>氏名</p>
                <input type="text" name="yourName">
            </div> -->
                <h3>氏名</h3>
                <?php
                echo h($_POST['yourName']);
                ?>
                <!-- <div>
                <p>メールアドレス</p>
                <input type="email" name="email">
            </div> -->
                <h3>メールアドレス</h3>
                <?php
                echo h($_POST['email']);
                ?>
                <div>
                    <h3>ホームページ</h3>
                    <?php
                    echo h($_POST['url']);
                    ?>
                </div>
                <div>
                    <h3>性別</h3>
                    <?php
                    if ($_POST['gender'] === '0') {
                        echo '男性';
                    }
                    if ($_POST['gender'] === '1') {
                        echo '女性';
                    }
                    ?>
                </div>
                <div>
                    <h3>年齢</h3>
                    <?php
                    if ($_POST['age'] === '0') {
                        echo '~19歳<';
                    }
                    if ($_POST['age'] === '1') {
                        echo '20~29歳';
                    }
                    if ($_POST['age'] === '2') {
                        echo '30~39歳';
                    }
                    if ($_POST['age'] === '3') {
                        echo '40~49歳';
                    }
                    if ($_POST['age'] === '4') {
                        echo '50~59歳';
                    }
                    if ($_POST['age'] === '5') {
                        echo '60~69歳';
                    }
                    if ($_POST['age'] === '6') {
                        echo '70歳~';
                    }
                    ?>
                </div>
                <h3>お問い合わせ内容</h3>
                <?php
                echo h($_POST['contact']);
                ?>


                <button name="btn-submit" value="送信する">確認する</button>
                <input type="hidden" name="yourName" value=" <?php echo h($_POST['yourName']); ?>" />
                <input type="hidden" name="email" value=" <?php echo h($_POST['email']); ?>" />
                <input type="hidden" name="url" value=" <?php echo h($_POST['url']); ?>" />
                <input type="hidden" name="gender" value=" <?php echo h($_POST['gender']); ?>" />
                <input type="hidden" name="age" value=" <?php echo h($_POST['age']); ?>" />
                <input type="hidden" name="contact" value=" <?php echo h($_POST['contact']); ?>" />

                <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>" />



                <button name="btn-back" value="戻る">戻る</button>
            </form>

        <?php endif; ?>
    <?php endif; ?>

    <?php
    if ($pageFlag === 2) : ?>
        <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>

            送信が完了しました。

            <?php unset($_SESSION['csrfToken']); ?>

        <?php endif; ?>
    <?php endif; ?>


    <!-- <form method="get" action="">
        <div>
            <p>氏名</p>
            <input type="text" name="yourName">

        </div>
        <div>
    <input type="checkbox" name="sports[]" value="野球">
    <label for="">野球</label>
    <input type="checkbox" name="sports[]" value="サッカー">
    <label for="">サッカー</label>
    <input type="checkbox" name="sports[]" value="バスケ">
    <label for="">バスケ</label>
</div>

        <button>送信</button>
    </form> -->


</body>

</html>