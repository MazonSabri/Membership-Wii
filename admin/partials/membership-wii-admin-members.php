<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://mostaql.com/u/mazonsabri
 * @since      1.0.0
 *
 * @package    Membership_Wii
 * @subpackage Membership_Wii/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h2 id="members-options-tile">Members List ( Add / Edit / Delete ) </h2>
<?php

$currentday = date('Y-m-d');

echo '<div class="table-members">';
echo '<form class="member-add-edit">
                <input name="membership_wii_ref" type="hidden" value="'.wp_create_nonce('membership_wii_nonce').'" />
                <input id="ajax_admin_url" type="hidden" value="'.admin_url('admin-ajax.php').'" />
                <input id="member-add-edit-action" name="action" type="hidden" value="membership_wii_ajax_add_edit" />
                <input type="text" name="name" id="name" class="form-control" placeholder="الإسم" required>  
                <input type="text" name="member_id" id="member_id" class="form-control" placeholder="رقم العضوية" required>  
                <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="هاتف" required>  
                <input type="date" name="started_at" id="started_at" class="form-control" placeholder="تاريخ البدء" value="'. date('Y-m-d') .'" required>
                <select name="ending_period" id="ending_period" placeholder="مدة الإشتراك" required>
                  <option disabled selected value> -- تاريخ الإنتهاء -- </option>
                  <option value="+1 years">Year</option>
                  <option value="+2 years">2 Years</option>
                  <option value="+3 years">3 Years</option>
                </select> 
                <button id="member-add-edit-submit" type="submit" class="">إضافة عضوية</button>  
            </form>';

$output = '<table class="styled-table-members">';
$output .= '<thead><tr><th>الإسم</th><th>رقم العضوية</th><th>الحالة</th><th>تاريخ البدء</th><th>تاريخ الإنتهاء</th><th>هاتف</th><th>إجراء</th></tr></thead><tbody>';

if (!empty($members)) {
  foreach ( $members as $member ) {
      $output .= '<tr>';
      $output .= '<td>'. $member->name .'</td>';
      $output .= '<td>'. $member->member_id .'</td>';
      $output .= '<td>'. (date('Y-m-d', strtotime($member->started_at . $member->ending_period)) > $currentday ? "نشط" : "غير نشط") .'</td>';
      $output .= '<td>'. date('Y-m-d', strtotime($member->started_at)) .'</td>';
      $output .= '<td>'. date('Y-m-d', strtotime($member->started_at . $member->ending_period)) .'</td>';
      $output .= '<td>'. $member->phone_number .'</td>';
      $output .= '<td data-id="'.  $member->member_id . '"><button class="member-edit">تعديل</button><button class="member-delete">حذف</button></td>';
      $output .= '</tr>';
  }
  echo $output;
} else {
  echo "<h2 style='text-align:center;'>Sorry, No users</h2>";
}
echo '</tbody></table>';
?>
  <div class="members-pagination">
    <?php 
      echo paginate_links( array(
          'base' => add_query_arg( 'cpage', '%#%' ),
          'format' => '',
          'prev_text' => __( 'Previous Page', 'membership-wii' ),
          'next_text' => __( 'Next Page', 'membership-wii' ),
          'total' => ceil($total / $items_per_page),
          'current' => $page
      ));
      ?>
  </div>
</div>