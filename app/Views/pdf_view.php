<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Codeigniter 4 PDF Example - positronx.io</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <style>
        * {
            font-family: 'edukai-4.0'
        }
        body {
            margin: 0;
        }
        .content {
            /* width: 820px;
            height: 1160px;
            margin: 0 auto; */

        }
        table{
            max-width: 2480px;
            border-collapse: collapse;
            width:100%;
            overflow: hidden;
             word-wrap: break-word;
        }
       td,th{
            width: 25%;

            border: 1px solid #000;
            text-align: left;
            padding:auto;
            padding-left: 5px;

        }
        .sign{
           height:50px !important;
        }

</style>
</head>

<body>
    <div class="content" id="content1">
        <h2 class="" style="font-weight:bold;text-align:center">【附表八】 臺中市建築工程餘土載運處理證明</h2>
        <h4 style="text-align:center">(依據廢棄物清理法第九條製作，運土車輛須隨車攜帶以供攔檢)</h4>
    
       <table width="100%" style="table-layout:fixed">
            <tr >
                <td width="25%">文件序號</td>
                <td width="25%"><?php echo $fileNumber;?></td>
                <td width="25%">文件有效日期</td>
                <td width="25%"><?php echo $effectiveDate;?></td>
            </tr>
            <tr>
                <td rowspan="2">建築物或拆除名稱</td>
                <td rowspan="2"><?php echo $buildingName;?></td>
                <td>工程餘土流向管制編號</td>
                <td><?php echo $projectNumber;?></td>

            </tr>
            <tr>
                <td>建造號碼</td>
                <td><?php echo $constructNumber;?></td>
            </tr>
            <tr>
                <td>建築物地點</td>
                <td colspan="3">
                    <?php echo $buildingAddress;?>
                    <!-- <span style="padding-left:30px;">縣市</span>
                    <span style="padding-left:30px;">鄉鎮市區</span>
                    <span style="padding-left:30px;">路街</span>
                    <span style="padding-left:30px;">段</span>
                    <span style="padding-left:30px;">巷</span>
                    <span style="padding-left:30px;">弄</span>
                    <span style="padding-left:30px;">號</span> -->
                </td>
            </tr>
            <tr>
                <td>起造人姓名及電話</td>
                <td colspan="3"><?php echo $starterName." ". $starterPhone;?></td>
            </tr>
            <tr>
                <td>承造人姓名及電話</td>
                <td colspan="3"><?php echo $contractUserName." ". $contractUserPhone;?></td>
            </tr>
            <tr>
                <td>監造人姓名及電話</td>
                <td colspan="3"><?php echo $contractWatcherName." ". $contractWatcherPhone;?></td>
            </tr>
            <tr>
                <td>駕駛人姓名駕照及身分證字號</td>
                <td colspan="3"><?php echo $clearingDriverName." ". $clearingDriverIdentityCard;?></td>
            </tr>
            <tr>
                <td>清運單位名稱負責人及電話</td>
                <td><?php echo $clearingCompanyName."</br>". $clearingCompanyPrincipalName."</br>". $clearingCompanyPhone;?></td>
                <td>車輛、船舶牌號</td>
                <td><?php echo $clearingDriverLicensePlate;?></td>
            </tr>
            <tr>
                <td>運送路線</td>
                <td colspan="3"><?php echo $transportationRoute;?></td>
            </tr>
            <tr>
                <td>剩餘土石載運數量</td>
                <td>
                    <?php echo $shippingQuantity;?>
                    <!-- <span style="padding-left:30px;">立方公尺或</span>
                    <span style="padding-left:30px;">公噸</span> -->
                </td>
                <td>載運內容(土質)</td>
                <td><?php echo $shippingContents;?></td>
            </tr>
            <tr>
                <td>合法收容處理場所名稱所在縣市負責人及電話</td>
                <td><?php echo $containmentCompanyName."</br>". $containmentCompanyPrincipalName."</br>". $containmentCompanyPrincipalPhone;?></td>
                <td>合法收容處理場所剩餘土石方流向</td>
                <td><?php echo $containmentPlaceEearthFlowNumer;?></td>
            </tr>

        </table>
        <table width="100%" style="table-layout:fixed">
            <tr>
                <td width="20%">證明文件核發單位</td>
                <td width="20%">承造人監工簽名</td>
                <td width="20%">駕駛人簽名</td>
                <td width="20%">合法收容處理場所簽名</td>
                <td rowspan="2" width="20%">
                    <img width="100%" src="data:image/jpg;base64,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" width="100%">
                </td>
            </tr>
            <tr >
                <td class="sign">
                    <!-- <img width="100%" src="data:image/png;base64,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" /> -->
                </td>
                <td class="sign">
                    <?php echo $contractingSign;?>
                    <span style="font-size:12px;"><?php echo $contractingSignDate?></span> 
                </td>
                <td class="sign">
                    <?php echo $driverSign;?>
                    <span style="font-size:12px;"><?php echo $driverSignDate?></span> 
                </td>
                <td class="sign">
                    <?php echo $containmentPlaceSign;?>
                    <span style="font-size:12px;"><?php echo $containmentPlaceSignDate?></span>
                </td>
            </tr>
        </table>

       

    </div>
    <div style="width:100%;font-size:13px;margin-top:10px">
            <span style="font-size:15px">備註 : </span>
            <ol style="word-wrap: break-word;">
                <li>本文件計四聯，第一聯由承造人留存，第二聯由承清運單位留存，第三聯由合法收容處理場所或實際收容處理場所留存，第四聯由地方建築主管機關留存，主辦機關可視情況自行加聯。</li>
                <li>本文件須經核發單位編定序號始為有效。</li>
                <li>本文件內容單線部分由工地監工單位填寫。</li>
                <li>本證明文件各聯內容填寫錯誤時，可由簽章人員直接簽章更正確認後，依備註1規定辦理。未以直接簽章更正方式辦理者必須劃線刪除作廢，但作廢之憑證仍須保留不得撕毀。</li>
                <li>文件序號由核發單位編定並登錄之流水號。</li>
                <li>工程餘土流向管制編號由承包廠商上網登錄工程基本資料後取得之編號，網址為<span>http://140.96.175.34/spoil</span>(兩階段申報)。</li>
                <li>土方載運數量若採容積法請填立方公尺，若採重量法則填公噸。</li>
                <li>土質請填代碼，B1為岩塊、礫石、碎石或沙，B2&mdash;1為土壤與礫石及沙混和物(土壤體積比例少於30%)，B2&mdash;2為土壤與礫石及沙混和物(土壤體積比例介於30%至50%)，B2&mdash;3為土壤與礫石及沙混和物(土壤體積比例大於50%)，B3為粉土質土壤(沉泥)，B4為黏土質土壤，B5為磚塊或混泥土塊，B6為淤泥或含水量大於30%之土壤，B7為連續壁產生之皂土。</li>
                <li>合法收容處理場所餘土流向管制編號與註6相同網址，上網填寫基本資料表後取得該編號。</li>
                <li>本證明文件由本府委託相關公會、機構核發。</li>
            </ol>
        </div>

</body>

</html>