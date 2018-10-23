<div class="outer_all_page_overflow">
	<div class="lp_all_page_overflow">
		<div class="col-md-12">
		
		<?php
			echo '<h2>'.esc_html__("More Option", "listingpro").'</h2>';
			$getSwithButtonFieldsFilter = lp_get_extrafields_filter('checkbox');
				if(!empty($getSwithButtonFieldsFilter)){
		?>
				<!-- for switch -->
				<div class="lp_more_filter_data_section">
				
				<?php
					echo '<ul class="filter_data_switch_on_off">';
					foreach ($getSwithButtonFieldsFilter as $fieldPostID => $fieldVal) {
						echo '
							<li>
								<div class="lp_filter_data_heading_text">
								<h3>'.$fieldVal.'</h3>
								</div>
								<div class="lp_filter_button_switch">
									<a href="#" class="switch-fields"></a>
								</div>
							</li>
						';
					}
					echo '</ul>';
				?>
				
				</div>
			<?php
				}
			?>
			<!-- for multicheck -->
			<?php
				$getExtraFieldsFilter = lp_get_extrafields_filter('checkboxes');
				if(!empty($getExtraFieldsFilter)){
					
			?>
						<div class="lp_more_filter_data_section lp_extrafields_select">
						
						<?php
							foreach ($getExtraFieldsFilter as $fieldPostID => $fieldVal) {
								echo '<h3>' . $fieldVal . '</h3>';
								echo '<ul class="lp_filter_checkbox">';
								$getFieldsValue = listing_get_metabox_by_ID('multicheck-options', $fieldPostID);
								if (!empty($getFieldsValue)) {
									$getFieldsArray = explode(",", $getFieldsValue);
									if (!empty($getFieldsArray)) {
										foreach ($getFieldsArray as $optionVal) {
											$optionVal = trim($optionVal);
											echo '
												<li>
													<label class="filter_checkbox_container">'.$optionVal.'
														<input type="checkbox" value="'.$optionVal.'" name="lp_extrafields_select[]">
														<span class="filter_checkbox_checkmark"></span>
													</label>
												</li>
											';
										}
									}
								}
								echo '</ul>';
							}
						?>
							
						</div>
			<?php } ?>
			
			<!-- for radio -->
			<?php
				$getRadioFieldsFilter = lp_get_extrafields_filter('radio');
				if(!empty($getRadioFieldsFilter)){
					
			?>

					<div class="lp_more_filter_data_section lp_extrafields_select">
						<?php
							foreach ($getRadioFieldsFilter as $fieldPostID => $fieldVal) {
								echo '<h3>' . $fieldVal . '</h3>';
								echo '<ul class="lp_filter_checkbox">';
									
									$getFieldsValue = listing_get_metabox_by_ID('radio-options', $fieldPostID);
									if (!empty($getFieldsValue)) {
										$getFieldsArray = explode(",", $getFieldsValue);
										if (!empty($getFieldsArray)) {
											foreach ($getFieldsArray as $optionVal) {
												$optionVal = trim($optionVal);
									
											echo '
												<li>
													<label class="filter_radiobox_container">'.$optionVal.'
													  <input type="radio" name="radio" value="'.$optionVal.'" name="lp_extrafields_select[]">
													  <span class="filter_radio_select"></span>
													</label>
												</li>
											';
											}
										}
									}
								
								echo '</ul>';
							}
						?>
					</div>
			<?php
				}
			?>
			<div class="outer_filter_show_result_cancel">
			<div class="filter_show_result_cancel">
				<span id="filter_cancel_all">Cancel</span>
				
				<input type="submit" value="Show Results" id="filter_result">

			</div>
			</div>
			
		</div>
	</div>

</div>