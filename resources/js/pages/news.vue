<template>
    <div>
        <div class="row page-title m-3 p-2">
            <div class="col-12 col-lg-8 container">
                <h1>Latest News</h1>
                <p>In the news section of Bfin Financial Services Limited we will report you all important information about the development of the project, the expansion of Bitcoin-farms, as well as various promotions, bonuses, incentives for investors and technical improvements to the site.</p>
            </div>
        </div>
        <!--start main container-->
        <section class="main-container">
            <div class="main">
                <div class="container">
                    <div class="wrapper" :style="'background:url('+ $root.basepath +'/img/home.png) no-repeat 0 0;'">
                        <div class="news-container">
                            <ul class="row">
                                <ul class="row">
                                    <li>
                                        <div class="news">
                                            <center>
                                                <h3>No News Found</h3>
                                            </center>
                                        </div>
                                    </li>
                                </ul>
                                <div class="pagination">
                                    <ul class="clearfix">
                                    </ul>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
