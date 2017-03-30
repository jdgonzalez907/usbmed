<?= \Mini\Core\View::render('_templates/email/header', [], '') ?>
        <div style="background-color:transparent;">
            <div rel="col-num-container-box" style="Margin: 0 auto;min-width: 320px;max-width: 500px;width: 320px;width: calc(19000% - 98300px);overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
                <div style="border-collapse: collapse;display: table;width: 100%;">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 500px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->

                    <!--[if (mso)|(IE)]><td align="center"  width="500" style=" width:500px; padding-right: 0px; padding-left: 0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <div rel="col-num-container-box" class="col num12" style="min-width: 320px;max-width: 500px;width: 320px;width: calc(18000% - 89500px);background-color: transparent;">
                        <div style="background-color: transparent; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;">
                            <div style="line-height: 30px; font-size:1px">&nbsp;</div>


                            <div style="Margin-right: 10px; Margin-left: 10px;">
                                <div style="line-height: 10px; font-size: 1px">&nbsp;</div>
                                <div style="font-size:12px;line-height:14px;color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;text-align:left;">
                                    <p style="margin: 0;font-size: 14px;line-height: 17px"><span style="font-size: 24px; line-height: 28px;"><strong><span style="line-height: 28px; font-size: 24px;">Actualización a plancha #{_PLANCHA_}</span>
                                        </strong>
                                        </span>
                                    </p>
                                </div>

                            </div>


                            <div style="Margin-right: 10px; Margin-left: 10px;">
                                <div style="line-height: 5px; font-size: 1px">&nbsp;</div>
                                <div style="font-size:12px;line-height:14px;color:#777777;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;text-align:left;">
                                    <p style="margin: 0;font-size: 14px;line-height: 17px"><span style="font-size: 16px; line-height: 19px;">Estimado(a): {_NOMBRE_}<br></span>
                                    </p>
                                </div>

                                <div style="line-height: 5px; font-size: 1px">&nbsp;</div>
                            </div>


                            <div style="Margin-right: 10px; Margin-left: 10px;">
                                <div style="line-height: 15px; font-size: 1px">&nbsp;</div>
                                <div style="font-size:12px;line-height:14px;color:#777777;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;text-align:left;">
                                    <p style="margin: 0;font-size: 14px;line-height: 17px"><strong>Mensaje de actualización:</strong> <br>{_OBSERVACION_}
                                        <br>
                                    </p>
                                    <p style="margin: 0;font-size: 14px;line-height: 16px">&nbsp;
                                        <br>
                                    </p>
                                    <p style="margin: 0;font-size: 14px;line-height: 16px"><strong>Estado actual:</strong> <br>{_ESTADO_}</p>
                                </div>

                                <div style="line-height: 10px; font-size: 1px">&nbsp;</div>
                            </div>

                            <div style="line-height: 30px; font-size: 1px">&nbsp;</div>
                        </div>
                    </div>
                    <!--[if (mso)|(IE)]></td></table></td></tr></table><![endif]-->
                </div>
            </div>
        </div>
<?= \Mini\Core\View::render('_templates/email/footer', [], '') ?>