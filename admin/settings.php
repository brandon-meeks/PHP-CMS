<?php include "includes/admin_header.php" ?>


<script type="text/javascript">
function valueChanged()
{
    if($('#tracking_enabled').is(":checked"))   
        $("#trackingGA").show();
    else
        $("#trackingGA").hide();
}

</script>

<div id="wrapper">

        <!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>  
                    </div>
                </div>
                <!-- /.row -->

                <?php siteInfo(); ?>
                <?php updateSiteInfo(); ?>

                <?php 

                    $query = "SELECT * FROM site_settings ";
                    $settings_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($settings_query)) {
                        $siteName = $row['site_name'];
                        $siteEmail = $row['site_admin_email'];
                        $trackingEnabled = $row['googleAnalyticsIsEnabled'];
                        $trackingCode = $row['tracking_code'];
                    }

                ?>



                <div class="row">
                    <div class="col-md-6">
                        <form action="" method="POST" role="form">
                            <legend>Site Settings</legend>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="site_name">Site Name</label>
                                        <input type="text" class="form-control" value="<?php echo $siteName; ?>" id="site_name" name="site_name" placeholder="Input name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="site_email">Site Email Address</label>
                                        <input type="email" class="form-control" value="<?php echo $siteEmail; ?>" id="site_email" name="site_email" placeholder="you@example.com">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="site_name">Enable Google Analytics?</label>
                                        <input type="hidden" name="tracking_enabled" value="0">
                                        <input type="checkbox" data-toggle="toggle" class="form-control" value="" id="tracking_enabled" name="tracking_enabled" onchange="valueChanged()" <?php if($trackingEnabled == 1) { echo "checked";} ?>>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="trackingGA">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="site_name">Google Analytics</label>
                                        <input type="text" class="form-control" value="<?php echo $trackingCode; ?>" id="tracking_code" name="tracking_code" placeholder="UA-xxxxxxxx">
                                    </div>
                                </div>
                            </div>

                            <?php 

                                $query = "SELECT * FROM site_settings ";
                                $settings_query = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($settings_query)) {
                                    $siteName = $row['site_name'];

                                }

                                if(empty($siteName)) {
                                    echo "<button type='submit' name='save' value='save' class='btn btn-success'>Save</button>";
                                } else {
                                    echo "<button type='submit' name='update' value='update' class='btn btn-primary'>Update</button>";
                                }


                            ?>

<!--                             <button type="submit" name="save" value="save" class="btn btn-success">Save</button>
 -->                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!-- <script type="text/javascript">
    $("#tracking_enabled").click(function(){
        $("div").removeClass("hide");
    });
</script> -->

    
<?php include "includes/admin_footer.php" ?>