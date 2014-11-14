<?php
/**
 * Vista que se usa para poder visualizar los
 * datos de los usuarios que quieren ver los
 * datos de sus estados de cuentas y todas sus
 * transacciones
 **/
?>
<div class="span-14 last" id="show_states">
    <div class="span-14">
        <div class="span-13 last" style="font-weight: bold; color: #660068; font-size: 14px">
		    Entradas
		</div>
    </div>
    <?php if(!empty($entradas)): ?>
        <?php $total_in = count_data_inside($entradas, $mes, $ano); ?>
        <?php if($total_in != 0): ?>
    		<div class="span-14">	
    			<div class="span-13 last" style="color: #888888">
	    	        <div class="span-2">
            		    Fecha
		            </div>
        		    <div class="span-8">
		                Movimiento
            		</div>
	    	        <div class="span-3 last">
            		    Monto
		            </div>
    		    </div>
	    	    <?php $i = 1; ?>
                <?php foreach($entradas as $entrada): ?>
                    <?php $valores = get_date_filter($entrada->fechaDepositoComisionUsuario); ?>
                    <?php //CUT DATE JUST TO TWO SECTIONS
                          $valores2 = $mes . '-' . $ano; ?>
                    <?php if($valores == $valores2): ?>
			            <?php if($i%2 == 0): ?>
    			        	<div class="span-13 last" style="background: #C1C1C1">
	    		    	    	<div class="span-2">
		        			    	<?php echo $entrada->fechaDepositoComisionUsuario; ?>
    		    	    		</div>
	    	        			<div class="span-8">
		        	    			<?php $name_company_in = get_name_company($entrada->comisionRecibidaEmpresaId);
		        		    			  echo "Bonificacion de " . $name_company_in->negocioNombre; ?>
		    	    		    </div>
    		    		    	<div class="span-3 last" style="color: GREEN">
	    	    			    	<?php echo '$ ' . $entrada->comisionRecibidaUsuarioBonificacion; ?> (+)
    	    	    			</div>
	    	        			<div class="span-2">
		            				&nbsp;
		        	    		</div>
		    	    	    	<div class="span-8">
		    		    	    	<?php echo $entrada->comisionRecibidaNumeroReferencia; ?>
    		    			    </div>
        		    		</div>
	        	    	<?php else: ?>
		            		<div class="span-13 last" style="background: #FFFFFF">
		            			<div class="span-2">
		    	        			<?php echo $entrada->fechaDepositoComisionUsuario; ?>
			    	        	</div>
		    			        <div class="span-8">
		    				        <?php $name_company_in = get_name_company($entrada->comisionRecibidaEmpresaId);
		    					          echo "Bonificacion de " . $name_company_in->negocioNombre; ?>
        		    			</div>
	        	    			<div class="span-3 last" style="color: GREEN">
		            				<?php echo '$ ' . $entrada->comisionRecibidaUsuarioBonificacion; ?> (+)
		            			</div>
		    	        		<div class="span-2">
		    		        		&nbsp;
		    			        </div>
    		    			    <div class="span-8">
	    	    				    <?php echo $entrada->comisionRecibidaNumeroReferencia; ?>
    		        			</div>
	    	        		</div>
    	    		    <?php endif; ?>
	    	    	    <?php $i++; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="span-13 last" style="color: #660068; font-size: 14px">
                    No hay movimientos de entrada para este mes
                </div>
            <?php endif; ?>
			<div class="span-13 last">
				&nbsp;
			</div>
        </div>
    <?php else: ?>
        <div class="span-13 last" style="color: #660068; font-size: 14px">
            No hay Movimientos de entrada para este mes
        </div>
	<?php endif; ?>
    <br />
    <div class="span-14">
        <div class="span-13 last" style="font-weight: bold; font-size: 14px; color: #660068">
	        Salidas
    	</div>
    </div>
    <?php if(!empty($salidas)): ?>
        <?php $total = count_data_outside($salidas, $mes, $ano); ?>
        <?php if($total != 0): ?>
		    <div class="span-14"> 
	    		<div class="span-13 last" style="color: #888888">
		            <div class="span-2">
        	    	    Fecha
		            </div>
            		<div class="span-8">
	    	            Movimiento
            		</div>
		            <div class="span-3 last">
        		        Monto
    		        </div>
	    	    </div> 
                <?php $j = 1; ?>
                <?php foreach($salidas as $salida): ?>
                    <?php $valores = get_date_filter($salida->transaccionFechaHora); ?>
                    <?php //CUT DATE JUST TO TWO SECTIONS
                          $valores2 = $mes . '-' . $ano; ?>
                    <?php if($valores == $valores2): ?>
			    	    <?php if($j%2 == 0): ?>
    				    	<div class="span-13 last" style="background-color: #C1C1C1">
	    				    	<div class="span-2">
		    				    	<?php $fecha_deposito = explode(' ', $salida->transaccionFechaHora);
			    				    	  echo $fecha_deposito[0]; ?>
    			    			</div>
	    			    		<div class="span-8">
		    			    		<?php $name_company_out = get_name_company($salida->transaccionNegocioId);
			    			    		  echo "Pago a " . $name_company_out->negocioNombre; ?>
    				    		</div>
	    				    	<div class="span-3 last" style="color: RED">
		    				    	<?php echo '$ ' . $salida->transaccionTotalPagar; ?> (-)
    		    				</div>
	    		    			<div class="span-2">
		    		    			&nbsp;
			    		    	</div>
				    		    <div class="span-8">
					    		    <?php echo $salida->transaccionCodigoVenta; ?>
    						    </div>
        					</div>
	        			<?php else: ?>
		        			<div class="span-13 last" style="background-color: #FFFFFF">
			        			<div class="span-2">
				        			<?php $fecha_deposito = explode(' ', $salida->transaccionFechaHora);
					        			  echo $fecha_deposito[0]; ?>
						        </div>
        						<div class="span-8">
	        						<?php $name_company_out = get_name_company($salida->transaccionNegocioId);
		        						  echo "Pago a " . $name_company_out->negocioNombre; ?>
			        			</div>
				        		<div class="span-3 last" style="color: RED">
					        		<?php echo '$ ' . $salida->transaccionTotalPagar; ?> (-)
						        </div>
    						    <div class="span-2">
	    						    &nbsp;
    		    				</div>
	    		    			<div class="span-8">
		    		    			<?php echo $salida->transaccionCodigoVenta; ?>
			    		    	</div>
    			    		</div>
	    			    <?php endif; ?>
    		    		<?php $j++; ?>
                    <?php endif; ?>
			    <?php endforeach; ?>
            <?php else: ?>
                <div class="span-13 last" style="color: #660068; font-size: 14px">
                    No hay movimientos de salida para este mes
                </div>
            <?php endif; ?>
			<div class="span-13 last" style="margin-top: 20px">
				&nbsp;
			</div>
        </div>
    <?php else: ?>
        <div class="span-13 last" style="color: #660068; font-size: 14px">
            No hay movimientos de salida para este mes
        </div>
	<?php endif; ?>
</div>
