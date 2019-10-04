<template>
    <div>
        <div class="row page-title m-3 p-2">
            <div class="col-12 col-lg-8 container">
                <h1>Data Centers</h1>
                <p>Our powerful datacenters are the backbone of our profitable mining system of Bitcoins. Our business typically relies heavily upon these data centers, making it a focal point and critical asset for everyday mining operations.</p>
            </div>
        </div>
        <!--start main container-->
        <section class="main-container">
            <div class="main">
                <div class="container">
                    <div class="wrapper" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
                        <div class="page-heading text-center">
                            <h2>Our Data Center Locations</h2>
                            <p></p>
                        </div>
                        <div class="data-map">
                            <img class="img-responsive":src="$root.basepath + '/img/map.png'">
                            <div style="top:50px; left:400px;" class="info one">
                                <span class="map-marker"></span>
                                <div class="center-detail">
                                    <h5 class="city">Amsterdam</h5>
                                    <div class="rates">
                                    </div>
                                </div>
                            </div>
                            <div style="top:60px; left:357px;" class="info one">
                                <span class="map-marker"></span>
                                <div class="center-detail">
                                    <h5 class="city">Iceland</h5>
                                    <div class="rates">
                                    </div>
                                </div>
                            </div>
                            <div style="top:60px; left:134px;" class="info one">
                                <span class="map-marker"></span>
                                <div class="center-detail">
                                    <h5 class="city">Estonia</h5>
                                    <div class="rates">
                                    </div>
                                </div>
                            </div>
                            <div style="top:210px; right:169px;" class="info one">
                                <span class="map-marker"></span>
                                <div class="center-detail">
                                    <h5 class="city">Singapore</h5>
                                    <div class="rates">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="data-center-services">
                            <h2 class="text-center">Highest standards on all data center facility aspects</h2>
                            <div class="row">
                                <div class="column col dcs">
                                    <img class="centered-img":src="$root.basepath + '/img/dcs-1.png'">
                                    <h4>Highly available network</h4>
                                    <p>Bfin Financial Services Limited ‘s datacenters have a high connectivity network which enables smooth hash power for efficient mining of Bitcoins. No downtime due to highly available network, supports uninterrupted mining to go on.</p>
                                </div>
                                <div class="column col dcs">
                                    <img class="centered-img":src="$root.basepath + '/img/dcs-2.png'">
                                    <h4>Redundant electrical systems</h4>
                                    <p>In our datacenters redundancy or duplication of critical electrical system components increases reliability of the system, usually in the form of a backup or fail-safe, or to improve actual system performance which supports mining constancy.</p>
                                </div>
                                <div class="column col dcs">
                                    <img class="centered-img":src="$root.basepath + '/img/dcs-3.png'">
                                    <h4>High-end physical security</h4>
                                    <p>We make sure the datacenters are safe with installation of surveillance cameras , biometric identification of staff &amp; use of access cards. All these are necessary to secure our datacenters from intrusions &amp; threats.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
