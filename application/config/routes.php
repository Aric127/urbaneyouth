<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 	= "web";
$route['404_override'] = '';
$route['Event-Transactions'] 	= 'biller/event_transaction';
$route['Event-Transaction'] 	= 'admin/event_transaction';
$route['User-List'] 			= 'admin/user_list';
$route['User-Transaction'] 		= 'admin/view_transaction';
$route['View-Transaction'] 		= 'admin/user_perticuler_transaction';
$route['EventList'] 			= 'admin/event_list';
$route['Event_List'] 			= 'biller/event_list';
$route['My-Account'] 			= 'web/my_account';
$route['Transaction'] 			= 'web/my_transactions';
$route['Wallet'] 				= 'web/wallet';
$route['Payment-Details'] 		= 'web/payment_details';
$route['Payment-Response'] 		= 'web/response';
$route['Quick-Response'] 		= 'web/quick_response';
$route['Payment-Via-Card'] 		= 'web/payment_via_card';
$route['Guest-Via-Card'] 		= 'web/Guest_user_Payment_Card';
$route['Save-Cards'] 			= 'web/Save_Cards';
$route['BankTransfer'] 			= 'web/wallet_to_bank';
$route['GuestUser'] 			= 'admin/GuestUser';
$route['Register'] 			    = 'biller_login/register';
$route['Merchant'] 			    = 'biller_login/merchant';
$route['About'] 	            = 'web/about_us';
$route['ShareEarn']             =  'web/shareearn';
$route['ContactUs']             = 'web/contactus';
$route['Merchant-About']        =  'biller_login/about';
$route['Oyapad-Products']       =  'biller/oyapad_products';
$route['Oyapad-Category']		=  'biller/oyapad_prod_cat';
$route['Oyapad-Transactions']   =  'biller/oyapad_transactions';
$route['Biller-Profile']        =  'biller/biller_profile';
$route['Biller-Signup']         =  'biller_login/register';
$route['Biller-Login']         =  'biller_login/register';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
$route['Branches'] 				= 'biller/church_list'; 
$route['Add-Branch'] 			= 'biller/add_church'; 
$route['Add-Invoice'] 			= 'biller/add_biller_user'; 
$route['Invoice'] 				= 'biller/consumer_list'; 
$route['Consumer'] 				= 'biller/biller_consumer'; 
$route['Agents'] 				= 'admin/agent_list'; 