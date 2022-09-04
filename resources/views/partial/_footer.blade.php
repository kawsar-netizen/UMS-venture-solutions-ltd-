 

  <div class="footer">
                <!-- <div class="float-right">
                    10GB of <strong>250GB</strong> Free.
                </div> -->
                <div align="center">
                    <strong>Copyright</strong> &copy; Venture Solution Limited {{  date('Y')  }}
                </div>
            </div>
        </div>
        

 </div>
</div>
   

       
        
    <!-- Mainly scripts -->
 <script src="{{ asset('assets/js/jquery-3.2.1.slim.min.js') }} "></script>
 
  <script src="{{ asset('assets/js/js.js') }}"></script> 



<!-- Mainly scripts -->
<script src="{{ asset('assets/js/jquery-3.1.1.min.js')}}"></script>

<script src="{{ asset('assets/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('assets/js/date_picker.js')}}"></script>



<!-- jQuery Validator Js -->
<script src="{{ asset('assets/js/plugins/validator/validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/validator/additional-method.min.js') }}"></script>



<!-- ChartJS-->
<script src="{{asset('assets/js/plugins/chartJs/Chart.min.js')}}"></script>

<!-- Toster Js -->

<script src="{{ asset('assets/cute-alert.js') }}"></script>


<!-- Custom and plugin javascript -->
<script src="{{ asset('assets/js/inspinia.js')}}"></script>
<!-- <script src="{{ asset('assets/js/plugins/pace/pace.min.js')}}"></script> -->

  <script src="{{ asset('assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
 <script src="{{ asset('assets/js/demo/peity-demo.js') }}"></script>

 <script src="{{ asset('assets/js/select2.min.js') }}"></script>
 <script src="{{ asset('assets/js/time_picker.js') }}"></script>
 

 <script type="text/javascript">

    $(document).ready(function() {
         $('.select2').select2();
         $(".loader").hide();
    });


 </script>


        
        <script>
         $(function() {
            $( ".datepicker-1" ).datepicker(
                {
                    dateFormat: 'mm/dd/yy',changeMonth:true


                }
                );
         });
      </script>



        <script>
         $(function() {
            $( ".rtgs_tmp_exp_date" ).datepicker(
                {

                    dateFormat: 'mm/dd/yy',changeMonth:true


                }
                );
         });
      </script>



      <script>
        $('.rtgs_tmp_exp_time').timepicker({
             timeFormat: 'h:mm p',
            interval: 60,
            minTime: '10',
            maxTime: '6:00pm',
           
            startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    </script>

    <script>

     $(document).ready(function(){
               $('.double-scroll').doubleScroll();
            });

            $(document).ready(function() {
                $('#example').DataTable({

                  
                     "scrollX": true
             
             });
            } );
            
            
            
            
            (function($){
    $.widget("suwala.doubleScroll", {
  options: {
            contentElement: undefined, // Widest element, if not specified first child element will be used
   topScrollBarMarkup: '<div class="suwala-doubleScroll-scroll-wrapper" style="height: 20px;"><div class="suwala-doubleScroll-scroll" style="height: 20px;"></div></div>',
   topScrollBarInnerSelector: '.suwala-doubleScroll-scroll',   
   scrollCss: {             
    'overflow-x': 'scroll',
    'overflow-y':'scroll'
            },
   contentCss: {
    'overflow-x': 'scroll',
    'overflow-y':'scroll'
   }
        },  
        _create : function() {
            var self = this;
   var contentElement;

            // add div that will act as an upper scroll
   var topScrollBar = $($(self.options.topScrollBarMarkup));
            self.element.before(topScrollBar);

            // find the content element (should be the widest one)   
            if (self.options.contentElement !== undefined && self.element.find(self.options.contentElement).length !== 0) {
                contentElement = self.element.find(self.options.contentElement);
            }
            else {
                contentElement = self.element.find('>:first-child');
            }

            // bind upper scroll to bottom scroll
            topScrollBar.scroll(function(){
                self.element.scrollLeft(topScrollBar.scrollLeft());
            });
   
            // bind bottom scroll to upper scroll
            self.element.scroll(function(){
                topScrollBar.scrollLeft(self.element.scrollLeft());
            });

            // apply css
            topScrollBar.css(self.options.scrollCss);
            self.element.css(self.options.contentCss);

            // set the width of the wrappers
            $(self.options.topScrollBarInnerSelector, topScrollBar).width(contentElement[0].scrollWidth);
            topScrollBar.width(self.element[0].clientWidth);
        },
        refresh: function(){
            // this should be called if the content of the inner element changed.
            // i.e. After AJAX data load
            var self = this;
   var contentElement;
            var topScrollBar = self.element.parent().find('.suwala-doubleScroll-scroll-wrapper');

            // find the content element (should be the widest one)
            if (self.options.contentElement !== undefined && self.element.find(self.options.contentElement).length !== 0) {
                contentElement = self.element.find(self.options.contentElement);
            }
            else {
                contentElement = self.element.find('>:first-child');
            }

            // set the width of the wrappers
            $(self.options.topScrollBarInnerSelector, topScrollBar).width(contentElement[0].scrollWidth);
            topScrollBar.width(self.element[0].clientWidth);
        }
    });
})(jQuery);
         



        $(document).ready(function() {

            let toast = $('.toast');

            setTimeout(function() {
                toast.toast({
                    delay: 5000,
                    animation: true
                });
                toast.toast('show');

            }, 2200);

            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );




      

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [70,27,85],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });

        $(window).bind("scroll", function () {
            let toast = $('.toast');
            toast.css("top", window.pageYOffset + 20);

        });
    </script>
               



<!--datatables-->
  <script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
  <script type="text/javascript">
 

    $(document)
    .ready(function () {
        $('#myTable').dataTable({
            "autoWidth": false,
            "lengthChange": false,
            "pageLength": 50,



            "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }, 
        { "bSearchable": false, "aTargets": [ 0] }
    ]

    
        });
});




  </script>






    @stack('scripts')
</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.9.3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Sep 2020 06:07:03 GMT -->
</html>
