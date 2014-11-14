<?php
/**
 * Vista que se encaraga de contener el menu de los 
 * inbox que se tienen por parte del usuario asi como
 * los que ha enviado y los que ha creado. Tambien
 * el div donde se cargaran los mensajes
 **/
?>
<script type="text/javascript">
</script>
<div class="span-14 last" style="margin-top: 10px">
    <div class="soft-header">
        Mensajes de <?php echo get_name_user($this->session->userdata('id')); ?>
    </div>
    <div class="span-14 last tabs-menu"><!-- INICIO DEL MENU DINAMICO DEL INBOX -->
        <ul class="tab-3">
            <li>
                <a href="<?php echo base_url(); ?>index.php/inboxes/entrada/<?php echo $usuarios->id; ?>" class="inbox-usuarios">
                    Bandeja de Entrada
                </a>
            </li>
            <li>
                <a href="">
                    Enviar Mensaje
                </a>
            </li>
            <li>
                <a href="">
                    Mensajes Enviados
                </a>
            </li>
        </ul>
        <div id="uno"></div>
    </div><!-- FIN DEL DIV DEL MENU DINAMICO DEL INBOX --> 
</div>
