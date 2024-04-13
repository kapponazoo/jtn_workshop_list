<?php
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM jtn_ws_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ワークショップ</title>

</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">

      
      <?php foreach($values as $v){ ?>
        <p class=""><?=h($v["pref"])?></p>
        <h2><?=h($v["workshop_title"])?></h2>
        <h3>講師：<?=h($v["workshop_teacher"])?>先生</h3>
        <h3>会場：<?=h($v["facility_name"])?></h3>
        <p>会場住所：<?=h($v["facility_add"])?></p>

        <p><?=h($v["workshop_date"])?></p>
         <div>
          <img src="">
          <div>
<p class=""><?=h($v["workshop_description"])?></p>
<ul>
  <li><?=h($v["workshop_type"])?></li>
  <li><?=h($v["lebel_type"])?></li>
  <li><?=h($v["category_type01"])?><?=h($v["category_type02"])?><?=h($v["category_type03"])?><?=h($v["category_type04"])?><?=h($v["category_type05"])?><?=h($v["category_type00"])?><?=h($v["category_txt"])?></li>
  <li><?=h($v["reservation"])?></li>
</ul>
<p>参加費用：<?=h($v["workshop_fee"])?></p>
<p>持ちもの：<?=h($v["belongings"])?></p>
<p>参加費用：<?=h($v["workshop_fee"])?></p>
<p>詳細情報：<?=h($v["workshop_url"])?></p>
<p>お問い合わせ先：<?=h($v["contact"])?></p>
          </div>
         </div>
<a href="detail.php?id=<?=h($v["id"])?>"><button>更新</button></a>
<a href="delete.php?id=<?=h($v["id"])?>"><button>削除</button></a>
        
        </tr>
      <?php } ?>
      </table>

  </div>
</div>
<!-- Main[End] -->

<script>
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));
</script>
</body>
</html>
