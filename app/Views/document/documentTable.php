<!-- 各使用狀態聯單 -->
<?= $this->extend('layout_blade/documentList_layout') ?>
<?= $this->section('customCss') ?>

<?= $this->endSection() ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">文件表格</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Document Table</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
       
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
        
            <button class="btn btn-primary mb-2" onclick="history.back()">回上頁</button>
            
             <table class="table  fs-5">
                <thead>
                    <tr>
                        <th scope="col" colspan="4" class="text-center">工程基本資料</th>
                    </tr>
                </thead>
                <tbody style="word-break: break-all;">
                    <tr>
                        <td width="25%" class="table-warning">表單型態</td>
                        <td width="25%">公共工程</td>
                        <td width="25%" class="table-warning">申請縣市</td>
                        <td width="25%">臺中市</td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning" >聯單文件序號</td>
                        <td width="25%"><?php echo $projects['fileNumber'];?></td>
                        <td width="25%"class="table-warning">文件有效日期</td>
                        <td width="25%"><?php echo $projects['effectiveDate'];?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">工程 - 建物或拆除物名稱</td>
                        <td colspan="3" width="25%"><?php echo $projects['buildingName']?></td>
                    </tr>
                    <tr>
                        <td width="25%" class="table-warning">工程餘土流向管制編號</td>
                        <td width="25%"><?php echo $projects['projectNumber']?></td>
                        <td width="25%"class="table-warning">公共工程契約或建(拆)除號碼</td>
                        <td width="25%"><?php echo $projects['constructNumber']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">工程(建築物)地點</td>
                        <td colspan="3" width="25%"><?php echo $projects['buildingAddress']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">起造人(名稱)</td>
                        <td width="25%"><?php echo $projects['starterName']?></td>
                        <td width="25%" class="table-warning">起造人(電話)</td>
                        <td width="25%"><?php echo $projects['starterPhone']?></td>
                    </tr>
                    <tr>
                        <td width="25%" class="table-warning">承造人(名稱)</td>
                        <td width="25%"><?php echo $projects['contractUserName']?></td>
                        <td width="25%"class="table-warning">承造人(電話)</td>
                        <td width="25%"><?php echo $projects['contractUserPhone']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">監造人(名稱)</td>
                        <td width="25%"><?php echo $projects['contractWatcherName']?></td>
                        <td width="25%"class="table-warning">監造人(電話)</td>
                        <td width="25%"><?php echo $projects['contractWatcherPhone']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">清運業者(名稱)</td>
                        <td width="25%"><?php echo $projects['clearingCompanyName']?></td>
                        <td width="25%"class="table-warning">餘土土質種類</td>
                        <td width="25%"><?php echo $projects['shippingContents']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">合法收容場、負責人及電話</td>
                        <td width="25%">
                            <span><?php echo $projects['containmentCompanyName']?></span></br>
                            <span><?php echo $projects['containmentCompanyPrincipalName']?></span></br>
                            <span><?php echo $projects['containmentCompanyPrincipalPhone']?></span>
                        </td>
                        <td width="25%"class="table-warning">合法收容場編號</td>
                        <td width="25%"><?php echo $projects['containmentPlaceEearthFlowNumer']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">預定運送路線</td>
                        <td colspan="3" width="25%"><?php echo $projects['transportationRoute']?></td>
                    </tr>
                </tbody>
            </table>
           <table class="table fs-5">
                <thead>
                    <tr>
                        <th scope="col" colspan="4" class="text-center">憑證使用狀態</th>
                    </tr>
                </thead>
                <tbody style="word-break: break-all;">
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"class="table-warning">承造業者</td>
                        <td width="25%"class="table-warning">清運業者</td>
                        <td width="25%"class="table-warning">收容場所</td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">簽核人員</td>
                        <td width="25%"><?php echo $projects['contractUserName']?></td>
                        <td width="25%"><?php echo $projects['clearingCompanyName']?></td>
                        <td width="25%"><?php echo $projects['containmentCompanyName']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">簽核時間</td>
                        <td width="25%"><?php echo $projects['contractingSignDate']?></td>
                        <td width="25%"><?php echo $projects['driverSignDate']?></td>
                        <td width="25%"><?php echo $projects['containmentPlaceSignDate']?></td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"class="table-warning">稽查人員</td>
                        <td width="25%"class="table-warning">稽查結果</td>
                        <td width="25%"class="table-warning">稽查內容</td>
                    </tr>
                    <tr >
                        <td rowspan="2" width="25%"class="table-warning">詳細內容</td>
                        <td rowspan="2" width="25%"></td>
                        <td rowspan="2" width="25%"></td>
                        <td rowspan="2" width="25%"></td>
                    </tr>
                </tbody>
            </table>
            <!-- <h5 class="fw-bold text-center">載運車輛車頭及車斗圖片</h5>
            <div class="row">
                <div class="col-xl-6 col-md-6 col-12">
                    <img class="img-fluid mx-auto" src="<?php echo base_url('assets/car')."/".$projects["carFront"]?>"/>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <img class="img-fluid mx-auto" src="<?php echo base_url('assets/car')."/".$projects["carBody"]?>" />
                </div>
            </div> -->
            <table class="table table-striped fs-5">
                <thead>
                    <tr>
                        <th scope="col" colspan="2" class="text-center">載運車輛車頭及車斗圖片</th>
                    </tr>
                </thead>
                <tbody style="word-break: break-all;">
                    <tr>
                        <td width="50%">
                            <?php if($projects["carFront"]){?>
                                 <img class="img-fluid mx-auto" src="<?php echo base_url('assets/car')."/".$projects["carFront"]?>"/>
                            <?php }else{?>
                              <span>因收容尚未簽屬聯單，故尚無車頭圖片</span>  
                            <?php }?>
                           
                        </td>
                        <td  width="50%">
                            <?php if($projects["carFront"]){?>
                                 <img class="img-fluid mx-auto" src="<?php echo base_url('assets/car')."/".$projects["carBody"]?>"/>
                            <?php }else{?>
                                <span>因收容尚未簽屬聯單，故尚無車斗圖片</span>
                            <?php }?>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-grid gap-2">
                <a class="btn btn-primary p-3" type="button" href="<?php echo base_url('pdf/showPdf').'/'.$projects['pdf_id']?>" target="_blank">憑證下載</a>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>

<script type="text/javascript">

</script>
<?= $this->endSection() ?>