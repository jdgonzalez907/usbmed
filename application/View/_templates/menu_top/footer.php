                    </div>
                </div>
            </div>
        </div>
        
        <footer class="small">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 text-center">
                        <p>© Aplicaciones USB Medellín <?= date('Y') ?></p>
                        <p>
                            Detalles de contácto:
                            <span class="glyphicon glyphicon-earphone"></span>  57(4) 514 5600 ext 4337 - 
                            <a href="mailto:ingeniero.analista1@usbmed.edu.co"><span class="glyphicon glyphicon-envelope"></span> ingeniero.analista1@usbmed.edu.co</a>
                        </p>
                    </div>
                </div>
            </div>  
        </footer>
        
        <!-- Modal -->
        <div class="modal fade" id="modal_usbmed" tabindex="-1" role="dialog" aria-labelledby="modal_usbmed_title">
            <div class="modal-dialog" id="modal_usbmed_tipo_modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal_usbmed_title"></h4>
                    </div>
                    <div class="modal-body" id="modal_usbmed_body">
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
        <script src="<?= URL ?>js/bootstrap.min.js"></script>
        <script src="<?= URL ?>js/sitio.js"></script>
        <script><?= Mini\Core\View::getJs() ?></script>
    </body>
</html>