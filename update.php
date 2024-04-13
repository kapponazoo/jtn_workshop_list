<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//1. POSTデータ取得
$workshop_title = $_POST["workshop_title"];
$image = $_POST["image"];
$workshop_teacher = $_POST["workshop_teacher"];
$workshop_date = $_POST["workshop_date"];
$workshop_description = $_POST["workshop_description"];
$workshop_type = $_POST["workshop_type"];
$lebel_type = $_POST["lebel_type"];
$category_type01 = $_POST["category_type01"];
$category_type02 = $_POST["category_type02"];
$category_type03 = $_POST["category_type03"];
$category_type04 = $_POST["category_type04"];
$category_type05 = $_POST["category_type05"];
$category_type00 = $_POST["category_type00"];
$category_txt = $_POST["category_txt"];
$workshop_fee = $_POST["workshop_fee"];
$belongings = $_POST["belongings"];
$reservation = $_POST["reservation"];
$facility_name = $_POST["facility_name"];
$facility_add = $_POST["facility_add"];
$pref = $_POST["pref"];
$workshop_url = $_POST["workshop_url"];
$contact = $_POST["contact"];

//2. DB接続します

include("funcs.php");  //外部ファイルの読み込み
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE jtn_ws_table SET workshop_title=:workshop_title,image=:image,workshop_teacher=:workshop_teacher,workshop_date=:workshop_date_st,workshop_description=:workshop_description,workshop_type=:workshop_type,lebel_type=:lebel_type,category_type01=:category_type01,category_type02=:category_type02,category_type03=:category_type03,category_type04=:category_type04,category_type05=:category_type05,category_type00=:category_type00,category_txt=:category_txt,workshop_fee=:workshop_fee,belongings=:belongings,reservation=:reservation,facility_name=:facility_name,facility_add=:facility_add,pref=:pref,workshop_url=:workshop_url,contact=:contact WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':workshop_title', $workshop_title,   PDO::PARAM_STR);
$stmt->bindValue(':image', $image,   PDO::PARAM_STR);
$stmt->bindValue(':workshop_teacher', $workshop_teacher,   PDO::PARAM_STR);
$stmt->bindValue(':workshop_date', $workshop_date,   PDO::PARAM_STR);
$stmt->bindValue(':workshop_description', $workshop_description,   PDO::PARAM_STR);
$stmt->bindValue(':workshop_type', $workshop_type,   PDO::PARAM_STR);
$stmt->bindValue(':lebel_type', $lebel_type,   PDO::PARAM_STR);
$stmt->bindValue(':category_type01', $category_type01,   PDO::PARAM_STR);
$stmt->bindValue(':category_type02', $category_type02,   PDO::PARAM_STR);
$stmt->bindValue(':category_type03', $category_type03,   PDO::PARAM_STR);
$stmt->bindValue(':category_type04', $category_type04,   PDO::PARAM_STR);
$stmt->bindValue(':category_type05', $category_type05,   PDO::PARAM_STR);
$stmt->bindValue(':category_type00', $category_type00,   PDO::PARAM_STR);
$stmt->bindValue(':category_txt', $category_txt,   PDO::PARAM_STR);
$stmt->bindValue(':workshop_fee', $workshop_fee,   PDO::PARAM_STR);
$stmt->bindValue(':belongings', $belongings,   PDO::PARAM_STR);
$stmt->bindValue(':reservation', $reservation,   PDO::PARAM_STR);
$stmt->bindValue(':facility_name', $facility_name,   PDO::PARAM_STR);
$stmt->bindValue(':facility_add', $facility_add,   PDO::PARAM_STR);
$stmt->bindValue(':pref', $pref,   PDO::PARAM_STR);
$stmt->bindValue(':workshop_url', $workshop_url,   PDO::PARAM_STR);
$stmt->bindValue(':contact', $contact,   PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//画像の受け取り
if (isset($_FILES['image'])) {//送信ボタンが押された場合
    // var_dump($_FILES);
    // exit();
      $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
      $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
      $file = "images/$image";
    
      if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
          move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);//imagesディレクトリにファイル保存
          if (exif_imagetype($file)) {//画像ファイルかのチェック
              $message = '画像をアップロードしました';
    
          } else {
              $message = '画像ファイルではありません';
            }
          }};
          
//４．データ登録処理後
if($status==false){
sql_error($stmt);
}else{
redirect("select.php");
}






?>
