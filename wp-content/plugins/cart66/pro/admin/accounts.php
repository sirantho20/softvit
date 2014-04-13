<form action="<?php echo Cart66Common::replaceQueryString('page=cart66-accounts'); ?>" method='post'>
  <input type='hidden' name='cart66-action' value='save account' />
  <input type='hidden' name='account[id]' value='<?php echo $data['account']->id ?>' />
  <input type='hidden' name='plan[id]' value='<?php if(isset($data['plan'])) { echo $data['plan']->id; } ?>' />
  
  <div id="widgets-left" style="margin-right: 50px;">
    <div id="available-widgets">
    
      <div class="widgets-holder-wrap">
        <div class="sidebar-name">
          <div class="sidebar-name-arrow"><br/></div>
          <h3><?php _e( 'Account' , 'cart66' ); ?> <span><img class="ajax-feedback" alt="" title="" src="images/wpspin_light.gif"/></span></h3>
        </div>
        <div class="widget-holder" style="overflow: hidden; display: block;">
          
          <?php
            if(isset($data['errors']) && is_array($data['errors']) && count($data['errors']) > 0) {
              echo '<div style="padding: 10px;">';
              echo Cart66Common::showErrors($data['errors'], 'Unable to update account:');
              echo '</div>';
            }
          ?>
          
          <ul style="float: left;">
            <li>
              <label class="med" for="account-first_name"><?php _e( 'First name' , 'cart66' ); ?>:</label>
              <input type="text" name="account[first_name]" value="<?php echo $data['account']->firstName; ?>" id="account-first_name" />
            </li>
            <li>
              <label class="med" for="account-last_name"><?php _e( 'Last name' , 'cart66' ); ?>:</label>
              <input type="text" name="account[last_name]" value="<?php echo $data['account']->lastName; ?>" id="account-last_name" />
            </li>
            <li>
              <label class="med" for="account-email"><?php _e( 'Email' , 'cart66' ); ?>:</label>
              <input type="text" name="account[email]" value="<?php echo $data['account']->email; ?>" id="account-email" />
            </li>
            <li>
              <label class="med" for="account-username"><?php _e( 'Username' , 'cart66' ); ?>:</label>
              <input type="text" name="account[username]" value="<?php echo $data['account']->username; ?>" id="account-username" />
            </li>
            <li>
              <label class="med" for="account-password"><?php _e( 'Password' , 'cart66' ); ?>:</label>
              <input type="text" name="account[password]" value="" id="account-password" />
              <?php if($data['account']->id > 0): ?>
                <p class="label_desc"><?php _e( 'Leave blank unless changing' , 'cart66' ); ?></p>
              <?php endif; ?>
            </li>
          </ul>
          
          <ul style="float: left;">
            <li>
              <label class="med" for="plan-subscription_plan_name"><?php _e( 'Plan name' , 'cart66' ); ?>:</label>
              <input style="width: 375px;" type="text" name="plan[subscription_plan_name]" value="<?php echo htmlspecialchars($data['plan']->subscriptionPlanName); ?>" id="plan-subscription_plan_name" />
            </li>
            <li>
              <label class="med" for="plan-feature_level"><?php _e( 'Feature level' , 'cart66' ); ?>:</label>
              <input style="width: 375px;" type="text" name="plan[feature_level]" value="<?php echo $data['plan']->featureLevel; ?>" id="plan-feature_level" />
            </li>
            <li>
              <label class="med" for="plan-active_until"><?php _e( 'Active until' , 'cart66' ); ?>:</label>
              <input type="text" id="plan-active_until" name="plan[active_until]" value="<?php echo $data['activeUntil']; ?>" id="plan-active_until" /> 
              <input type="hidden" name="plan[lifetime]" value="" />
              <input type="checkbox" id="plan-lifetime" name="plan[lifetime]" value="1" <?php echo $data['plan']->lifetime == 1 ? 'checked="checked"' : '' ?>> <?php _e( 'Lifetime' , 'cart66' ); ?>
              <p class="label_desc" style="margin-bottom: 20px;"><?php _e( 'Enter dates like mm/dd/YYYY or time spans like +3 months.<br/>If this is s lifetime membership just click the Lifetime checkbox.' , 'cart66' ); ?></p>
            </li>
            <li><label class="med" for='account-notes'><?php _e( 'Notes' , 'cart66' ); ?>:</label><br/>
            <textarea style="width: 375px; height: 140px; margin-left: 130px; margin-top: -20px;" 
            id="account-notes" name="account[notes]"><?php echo $data['account']->notes; ?></textarea>
            <p style="margin-left: 130px;" class="description"><?php _e( 'Notes about this account - not viewable by customer.' , 'cart66' ); ?></p></li>
          </ul>
          
          <ul style="clear: both;">
            <li>
              <label class="med" for="submit">&nbsp;</label>
              <?php if($data['account']->id > 0): ?>
                <a href='?page=cart66-accounts' class='button-secondary linkButton' style=""><?php _e( 'Cancel' , 'cart66' ); ?></a>
              <?php endif; ?>
              <input type="submit" name="Save" value="Save" id="submit" class="button-primary" style='width: 60px;' />
            </li>
          </ul>
          
        </div>
      </div>
      
    </div>
  </div>
</form>

<?php if(isset($data['accounts']) && is_array($data['accounts'])): ?>
  <table class="widefat Cart66HighlightTable" style="width: 95%" id="Cart66AccountList">
    <thead>
      <tr>
        <th colspan="8">
          <div class="Cart66AccountSearchWrapper">
            <?php _e( 'Search' , 'cart66' ); ?>: <input type="text" name="Cart66AccountSearchField" value="" id="Cart66AccountSearchField" />
          </div>
          <div class="Cart66AccountRowCount"></div>
        </th>
      </tr>
      <tr>
        <th><?php _e( 'Name' , 'cart66' ); ?></th>
        <th><?php _e( 'Username' , 'cart66' ); ?></th>
        <th><?php _e( 'Email' , 'cart66' ); ?></th>
        <th><?php _e( 'Subscription Name' , 'cart66' ); ?></th>
        <th><?php _e( 'Feature Level' , 'cart66' ); ?></th>
        <th><?php _e( 'Active Until' , 'cart66' ); ?></th>
        <th><?php _e( 'Type' , 'cart66' ); ?></th>
        <th><?php _e( 'Actions' , 'cart66' ); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data['accounts'] as $acct): ?>
        <?php
          $editLink = $data['url'] . '&accountId=' . $acct->id;
          $deleteLink = $data['url'] . '&accountId=' . $acct->id . '&cart66-action=delete_account';
          $planName = 'No Active Subscription';
          $featureLevel = 'No Access';
          $activeUntil = 'Expired';
          if($sub = $acct->getCurrentAccountSubscription(true)) {
            $planName = $sub->subscriptionPlanName;
            $featureLevel = $sub->isActive() ? $sub->featureLevel : 'No Access - Expired';
            $activeUntil = ($sub->lifetime == 1) ? "Lifetime" : date('m/d/Y', strtotime($sub->activeUntil));
            $type = 'Manual';
            if($sub->isPayPalSubscription()) {
              $type = 'PayPal';
            }
            elseif($sub->isSpreedlySubscription()) {
              $type = 'Spreedly';
            }
          }
          else {
            $planName = 'No plan available';
            $featureLevel = 'No feature level';
            $activeUntil = 'No Access';
            $type = 'None';
          }
        ?>
        <tr>
          <td><?php echo $acct->firstName ?> <?php echo $acct->lastName ?></td>
          <td><?php echo $acct->username ?></td>
          <td><a href="mailto:<?php echo $acct->email ?>"><?php echo $acct->email ?></a></td>
          <td><?php echo $planName; ?></td>
          <td>
            <?php echo $featureLevel; ?>
          </td>
          <td><?php echo $activeUntil; ?></td>
          <td><?php echo $type; ?></td>
          <td>
            <a href="<?php echo $editLink; ?>"><?php _e( 'Edit' , 'cart66' ); ?></a> |
            <a href="<?php echo $deleteLink; ?>" class="delete"><?php _e( 'Delete' , 'cart66' ); ?></a>
          
            <?php if(!empty($acct->notes)): ?>
            | <a href="#" class="Cart66ViewAccountNote" rel="note_<?php echo $acct->id ?>"><?php _e( 'Notes' , 'cart66' ); ?></a>
            <div class="Cart66AccountNote" id="note_<?php echo $acct->id; ?>">
              <a href="#" class="Cart66CloseNoteView" rel="note_<?php echo $acct->id ?>" alt="Close Notes Window"><img src="<?php 
                echo CART66_URL ?>/images/window-close.png" /></a>
              <h3><?php echo $acct->firstName ?> <?php echo $acct->lastName ?></h3>
              <p><?php echo nl2br($acct->notes); ?></p>
            </div>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script type="text/javascript">
    (function($){
      $(document).ready(function(){
        $('.delete').click(function() {
          return confirm('Are you sure you want to permanently delete this account?');
        });

        $("#plan-feature_level").keydown(function(e) {
          if (e.keyCode == 32) {
            $(this).val($(this).val() + ""); // append '-' to input
            return false; // return false to prevent space from being added
          }
        }).change(function(e) {
            $(this).val(function (i, v) { return v.replace(/ /g, ""); }); 
        });

        $('.Cart66ViewAccountNote').click(function() {
          var id = $(this).attr('rel');
          $('#' + id).css('display', 'block');
          return false;
        });

        $('.Cart66CloseNoteView').click(function() {
          var id = $(this).attr('rel');
          $('#' + id).css('display', 'none');
          return false;
        });

        $('#plan-lifetime').click(function() {
          if($('#plan-lifetime').attr('checked') == true) {
            $('#plan-active_until').val('');
          }
        });

        $('#Cart66AccountSearchField').quicksearch('table tbody tr', {
          'onAfter': function () {
             var rowCount = $('tr:visible').length; 
             $('.Cart66AccountRowCount').html((rowCount-2) + " Accounts Found");
          }
        });
        
        $("#plan-active_until").datepicker();
      })
    })(jQuery);
  </script> 
<?php endif; ?>