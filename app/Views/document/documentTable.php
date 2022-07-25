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
                        <td width="25%"><?php echo $projects['pdf_fileNumber'];?></td>
                        <td width="25%"class="table-warning">文件有效日期</td>
                        <td width="25%"><?php echo $projects['pdf_effectiveDate'];?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">工程 - 建物或拆除物名稱</td>
                        <td colspan="3" width="25%"><?php echo $projects['pdf_buildingName']?></td>
                    </tr>
                    <tr>
                        <td width="25%" class="table-warning">工程餘土流向管制編號</td>
                        <td width="25%"><?php echo $projects['engineering_projectNumber']?></td>
                        <td width="25%"class="table-warning">公共工程契約或建(拆)除號碼</td>
                        <td width="25%"><?php echo $projects['pdf_constructNumber']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">工程(建築物)地點</td>
                        <td colspan="3" width="25%"><?php echo $projects['pdf_buildingAddress']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">起造人(名稱)</td>
                        <td width="25%"><?php echo $projects['pdf_starterName']?></td>
                        <td width="25%" class="table-warning">起造人(電話)</td>
                        <td width="25%"><?php echo $projects['pdf_starterPhone']?></td>
                    </tr>
                    <tr>
                        <td width="25%" class="table-warning">承造人(名稱)</td>
                        <td width="25%"><?php echo $projects['contracting_contractUserName']?></td>
                        <td width="25%"class="table-warning">承造人(電話)</td>
                        <td width="25%"><?php echo $projects['contracting_contractUserPhone']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">監造人(名稱)</td>
                        <td width="25%"><?php echo $projects['contracting_contractWatcherName']?></td>
                        <td width="25%"class="table-warning">監造人(電話)</td>
                        <td width="25%"><?php echo $projects['contracting_contractWatcherPhone']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">清運業者(名稱)</td>
                        <td width="25%"><?php echo $projects['clearingCompany_name']?></td>
                        <td width="25%"class="table-warning">餘土土質種類</td>
                        <td width="25%"><?php echo $projects['pdf_shippingContents']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">合法收容場、負責人及電話</td>
                        <td width="25%">
                            <span><?php echo $projects['containmentCompany_name']?></span></br>
                            <span><?php echo $projects['containmentCompany_principalName']?></span></br>
                            <span><?php echo $projects['containmentCompany_principalPhone']?></span>
                        </td>
                        <td width="25%"class="table-warning">合法收容場編號</td>
                        <td width="25%"><?php echo $projects['pdf_shippingContents']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">預定運送路線</td>
                        <td colspan="3" width="25%"><?php echo $projects['pdf_transportationRoute']?></td>
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
                        <td width="25%"><?php echo $projects['contracting_companyName']?></td>
                        <td width="25%"><?php echo $projects['clearingCompany_name']?></td>
                        <td width="25%"><?php echo $projects['containmentCompany_name']?></td>
                    </tr>
                    <tr>
                        <td width="25%"class="table-warning">簽核時間</td>
                        <td width="25%"><?php echo $projects['pdf_contractingSignDate']?></td>
                        <td width="25%"><?php echo $projects['pdf_driverSignDate']?></td>
                        <td width="25%"><?php echo $projects['pdf_containmentPlaceSignDate']?></td>
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
                    <img class="img-fluid mx-auto" src="<?php echo base_url('assets/car')."/".$projects["pdf_carFront"]?>"/>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <img class="img-fluid mx-auto" src="<?php echo base_url('assets/car')."/".$projects["pdf_carBody"]?>" />
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
                            <img class="img-fluid mx-auto" src="<?php echo base_url('assets/car')."/".$projects["pdf_carFront"]?>"/>
                        </td>
                        <td  width="50%">
                            <img class="img-fluid mx-auto" src="<?php echo base_url('assets/car')."/".$projects["pdf_carBody"]?>" />
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