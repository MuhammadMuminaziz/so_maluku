<?php

require_once("../configuration/connection.php");
$query = "SELECT * FROM `app_settings` WHERE `key` = 'admob'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);
    }else {
        $value = null;
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">AdMob Configuration</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="savesetting.php">
                            <input type="hidden" name="type" value="admob" />
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="input_admobBannerID" class="form-label">AdMob Banner Unit ID-Android (optional)  </label>
                                    <input type="text" class="form-control" name="admobBannerID" value ="<?= isset($value) && isset($value->admobBannerID)  ? $value->admobBannerID : '' ?>" placeholder="Enter Your admob banner id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input_admobIntentialID" class="form-label">AdMob Interstitial Unit ID-Android (optional)  </label>
                                    <input type="text" class="form-control" name="admobIntentialID" value ="<?= isset($value) && isset($value->admobIntentialID)  ? $value->admobIntentialID : '' ?>" placeholder="Enter Your admob intential id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input_admobBannerIDIOS" class="form-label">AdMob Banner Unit ID-iOS (optional)  </label>
                                    <input type="text" class="form-control" name="admobBannerIDIOS" value ="<?= isset($value) && isset($value->admobBannerIDIOS)  ? $value->admobBannerIDIOS : '' ?>" placeholder="Enter Your admob banner id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input_admobIntentialIDIOS" class="form-label">AdMob Interstitial Unit ID-iOS (optional)  </label>
                                    <input type="text" class="form-control" name="admobIntentialIDIOS" value ="<?= isset($value) && isset($value->admobIntentialIDIOS)  ? $value->admobIntentialIDIOS : '' ?>" placeholder="Enter Your admob intential id">
                                </div>
                            </div>
                            <hr>
                            <input type="submit" class="btn btn-primary" value="Save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>