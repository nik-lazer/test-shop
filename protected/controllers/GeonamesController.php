<?php

class GeonamesController extends Controller {
    public function actionIndex() {
        $list = Yii::App()->search->select('*')->
            from(‘geonames_index’)->
            where('Rebecca')->
            orderby(array('name asc'))->
            //filters(array('rubric_id'=>4))->
            search();
        //print_r($list->getRawData());
        $this->render('result', array('list'=>$list->getRawData()));
    }
    
    public function actionSql() {
        $command = Yii::app()->getDb()->createCommand("select * from geonames where name like :name order by name");
        $name = '%Rebecca%';
        $command->bindParam(':name', $name);
        $list = $command->queryAll();
        $this->render('result', array('list'=>$list));       
    }
    
    public function actionTest() {
        $cl = new SphinxClient();
    $cl->SetServer( "localhost", 9312 );

    // Собственно поиск
    $cl->SetMatchMode( SPH_MATCH_ANY  ); // ищем хотя бы 1 слово из поисковой фразы
    $result = $cl->Query("Rebecca", 'geonames_index'); // поисковый запрос

    // обработка результатов запроса
    if ( $result === false ) { 
          echo "Query failed: " . $cl->GetLastError() . ".\n"; // выводим ошибку если произошла
      }
      else {
          if ( $cl->GetLastWarning() ) {
              echo "WARNING: " . $cl->GetLastWarning() . " // выводим предупреждение если оно было
    ";
          }

          if ( ! empty($result["matches"]) ) { // если есть результаты поиска - обрабатываем их
              foreach ( $result["matches"] as $product => $info ) {
                    echo $product.' - '.print_r($info, true) . "<br />"; // просто выводим id найденных товаров
              }
          }
      }
    }
}