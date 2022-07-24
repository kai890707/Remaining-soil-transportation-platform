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
                  <?php echo $docQrcode?>
                </td>
            </tr>
            <tr >
                <td class="sign">
                   
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