<?php
session_start();

// フォルダの指定（ここを変更すれば何かどうにかなる）
$dir = "./img/";
// ファイルの一覧を取得(増やす場合は拡張子を入れればOKなはず）
$filelist = glob($dir . '*.{jpg,png}', GLOB_BRACE);
// 画像のインデックスをリセット
$current_index = isset($_SESSION['current_index']) ? $_SESSION['current_index'] : 0;

// ボタン操作if
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'next') {
        $current_index++;
        $_SESSION['current_index'] = $current_index;
    } elseif ($_POST['action'] === 'copy') {
        copy($filelist[$current_index], './img/hit/' . basename($filelist[$current_index]));
        $current_index++;
        $_SESSION['current_index'] = $current_index;
    } elseif ($_POST['action'] === 'copy2') {
        copy($filelist[$current_index], './img/del/' . basename($filelist[$current_index]));
        $current_index++;
        $_SESSION['current_index'] = $current_index;
    } elseif ($_POST['action'] === 'reset') {
        $current_index = 0;
        $_SESSION['current_index'] = $current_index;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>テスト</title>
</head>

<body>
    <!-- 画像を表示するif文 -->
    <?php
    if (isset($filelist[$current_index])) {
        echo "<img src=\"{$filelist[$current_index]}\">";
    } else {
        echo "すべての画像を表示しました。";
    }
    ?>

    <!-- 次へボタン
    <form method="post">
        <input type="hidden" name="action" value="next">
        <input type="submit" value="次へ">
    </form> -->

    <!-- Hitフォルダにコピーして次へボタン -->
    <form method="post">
        <input type="hidden" name="action" value="copy">
        <input type="submit" value="Hitフォルダにコピーして次へ">
    </form>

    <!-- delフォルダにコピーして次へボタン -->
    <form method="post">
        <input type="hidden" name="action" value="copy2">
        <input type="submit" value="delフォルダにコピーして次へ">
    </form>

    <!-- 画像を最初から読み直すボタン -->
    <form method="post">
        <input type="hidden" name="action" value="reset">
        <input type="submit" value="画像を最初から読み直す">
    </form>
</body>

</html>
