<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "t95_rkas2info.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$t95_rkas2_delete = NULL; // Initialize page object first

class ct95_rkas2_delete extends ct95_rkas2 {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}';

	// Table name
	var $TableName = 't95_rkas2';

	// Page object name
	var $PageObjName = 't95_rkas2_delete';

	// Page headings
	var $Heading = '';
	var $Subheading = '';

	// Page heading
	function PageHeading() {
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->TableCaption();
		return "";
	}

	// Page subheading
	function PageSubheading() {
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t95_rkas2)
		if (!isset($GLOBALS["t95_rkas2"]) || get_class($GLOBALS["t95_rkas2"]) == "ct95_rkas2") {
			$GLOBALS["t95_rkas2"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t95_rkas2"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't95_rkas2', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct96_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t95_rkas2list.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->id->Visible = FALSE;
		$this->no_urut->SetVisibility();
		$this->keterangan->SetVisibility();
		$this->jumlah->SetVisibility();
		$this->no_keyfield->SetVisibility();
		$this->no_level->SetVisibility();
		$this->nama_tabel->SetVisibility();
		$this->id_data->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $t95_rkas2;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t95_rkas2);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("t95_rkas2list.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in t95_rkas2 class, t95_rkas2info.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("t95_rkas2list.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues($rs = NULL) {
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->NewRow(); 

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->no_urut->setDbValue($row['no_urut']);
		$this->keterangan->setDbValue($row['keterangan']);
		$this->jumlah->setDbValue($row['jumlah']);
		$this->no_keyfield->setDbValue($row['no_keyfield']);
		$this->no_level->setDbValue($row['no_level']);
		$this->nama_tabel->setDbValue($row['nama_tabel']);
		$this->id_data->setDbValue($row['id_data']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['no_urut'] = NULL;
		$row['keterangan'] = NULL;
		$row['jumlah'] = NULL;
		$row['no_keyfield'] = NULL;
		$row['no_level'] = NULL;
		$row['nama_tabel'] = NULL;
		$row['id_data'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->no_urut->DbValue = $row['no_urut'];
		$this->keterangan->DbValue = $row['keterangan'];
		$this->jumlah->DbValue = $row['jumlah'];
		$this->no_keyfield->DbValue = $row['no_keyfield'];
		$this->no_level->DbValue = $row['no_level'];
		$this->nama_tabel->DbValue = $row['nama_tabel'];
		$this->id_data->DbValue = $row['id_data'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->jumlah->FormValue == $this->jumlah->CurrentValue && is_numeric(ew_StrToFloat($this->jumlah->CurrentValue)))
			$this->jumlah->CurrentValue = ew_StrToFloat($this->jumlah->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// no_urut
		// keterangan
		// jumlah
		// no_keyfield
		// no_level
		// nama_tabel
		// id_data

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// no_urut
		$this->no_urut->ViewValue = $this->no_urut->CurrentValue;
		$this->no_urut->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

		// jumlah
		$this->jumlah->ViewValue = $this->jumlah->CurrentValue;
		$this->jumlah->ViewCustomAttributes = "";

		// no_keyfield
		$this->no_keyfield->ViewValue = $this->no_keyfield->CurrentValue;
		$this->no_keyfield->ViewCustomAttributes = "";

		// no_level
		$this->no_level->ViewValue = $this->no_level->CurrentValue;
		$this->no_level->ViewCustomAttributes = "";

		// nama_tabel
		$this->nama_tabel->ViewValue = $this->nama_tabel->CurrentValue;
		$this->nama_tabel->ViewCustomAttributes = "";

		// id_data
		$this->id_data->ViewValue = $this->id_data->CurrentValue;
		$this->id_data->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// no_urut
			$this->no_urut->LinkCustomAttributes = "";
			$this->no_urut->HrefValue = "";
			$this->no_urut->TooltipValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";
			$this->keterangan->TooltipValue = "";

			// jumlah
			$this->jumlah->LinkCustomAttributes = "";
			$this->jumlah->HrefValue = "";
			$this->jumlah->TooltipValue = "";

			// no_keyfield
			$this->no_keyfield->LinkCustomAttributes = "";
			$this->no_keyfield->HrefValue = "";
			$this->no_keyfield->TooltipValue = "";

			// no_level
			$this->no_level->LinkCustomAttributes = "";
			$this->no_level->HrefValue = "";
			$this->no_level->TooltipValue = "";

			// nama_tabel
			$this->nama_tabel->LinkCustomAttributes = "";
			$this->nama_tabel->HrefValue = "";
			$this->nama_tabel->TooltipValue = "";

			// id_data
			$this->id_data->LinkCustomAttributes = "";
			$this->id_data->HrefValue = "";
			$this->id_data->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t95_rkas2list.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t95_rkas2_delete)) $t95_rkas2_delete = new ct95_rkas2_delete();

// Page init
$t95_rkas2_delete->Page_Init();

// Page main
$t95_rkas2_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t95_rkas2_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ft95_rkas2delete = new ew_Form("ft95_rkas2delete", "delete");

// Form_CustomValidate event
ft95_rkas2delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft95_rkas2delete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t95_rkas2_delete->ShowPageHeader(); ?>
<?php
$t95_rkas2_delete->ShowMessage();
?>
<form name="ft95_rkas2delete" id="ft95_rkas2delete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t95_rkas2_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t95_rkas2_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t95_rkas2">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($t95_rkas2_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($t95_rkas2->id->Visible) { // id ?>
		<th class="<?php echo $t95_rkas2->id->HeaderCellClass() ?>"><span id="elh_t95_rkas2_id" class="t95_rkas2_id"><?php echo $t95_rkas2->id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_rkas2->no_urut->Visible) { // no_urut ?>
		<th class="<?php echo $t95_rkas2->no_urut->HeaderCellClass() ?>"><span id="elh_t95_rkas2_no_urut" class="t95_rkas2_no_urut"><?php echo $t95_rkas2->no_urut->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_rkas2->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $t95_rkas2->keterangan->HeaderCellClass() ?>"><span id="elh_t95_rkas2_keterangan" class="t95_rkas2_keterangan"><?php echo $t95_rkas2->keterangan->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_rkas2->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $t95_rkas2->jumlah->HeaderCellClass() ?>"><span id="elh_t95_rkas2_jumlah" class="t95_rkas2_jumlah"><?php echo $t95_rkas2->jumlah->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_rkas2->no_keyfield->Visible) { // no_keyfield ?>
		<th class="<?php echo $t95_rkas2->no_keyfield->HeaderCellClass() ?>"><span id="elh_t95_rkas2_no_keyfield" class="t95_rkas2_no_keyfield"><?php echo $t95_rkas2->no_keyfield->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_rkas2->no_level->Visible) { // no_level ?>
		<th class="<?php echo $t95_rkas2->no_level->HeaderCellClass() ?>"><span id="elh_t95_rkas2_no_level" class="t95_rkas2_no_level"><?php echo $t95_rkas2->no_level->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_rkas2->nama_tabel->Visible) { // nama_tabel ?>
		<th class="<?php echo $t95_rkas2->nama_tabel->HeaderCellClass() ?>"><span id="elh_t95_rkas2_nama_tabel" class="t95_rkas2_nama_tabel"><?php echo $t95_rkas2->nama_tabel->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_rkas2->id_data->Visible) { // id_data ?>
		<th class="<?php echo $t95_rkas2->id_data->HeaderCellClass() ?>"><span id="elh_t95_rkas2_id_data" class="t95_rkas2_id_data"><?php echo $t95_rkas2->id_data->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t95_rkas2_delete->RecCnt = 0;
$i = 0;
while (!$t95_rkas2_delete->Recordset->EOF) {
	$t95_rkas2_delete->RecCnt++;
	$t95_rkas2_delete->RowCnt++;

	// Set row properties
	$t95_rkas2->ResetAttrs();
	$t95_rkas2->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$t95_rkas2_delete->LoadRowValues($t95_rkas2_delete->Recordset);

	// Render row
	$t95_rkas2_delete->RenderRow();
?>
	<tr<?php echo $t95_rkas2->RowAttributes() ?>>
<?php if ($t95_rkas2->id->Visible) { // id ?>
		<td<?php echo $t95_rkas2->id->CellAttributes() ?>>
<span id="el<?php echo $t95_rkas2_delete->RowCnt ?>_t95_rkas2_id" class="t95_rkas2_id">
<span<?php echo $t95_rkas2->id->ViewAttributes() ?>>
<?php echo $t95_rkas2->id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_rkas2->no_urut->Visible) { // no_urut ?>
		<td<?php echo $t95_rkas2->no_urut->CellAttributes() ?>>
<span id="el<?php echo $t95_rkas2_delete->RowCnt ?>_t95_rkas2_no_urut" class="t95_rkas2_no_urut">
<span<?php echo $t95_rkas2->no_urut->ViewAttributes() ?>>
<?php echo $t95_rkas2->no_urut->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_rkas2->keterangan->Visible) { // keterangan ?>
		<td<?php echo $t95_rkas2->keterangan->CellAttributes() ?>>
<span id="el<?php echo $t95_rkas2_delete->RowCnt ?>_t95_rkas2_keterangan" class="t95_rkas2_keterangan">
<span<?php echo $t95_rkas2->keterangan->ViewAttributes() ?>>
<?php echo $t95_rkas2->keterangan->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_rkas2->jumlah->Visible) { // jumlah ?>
		<td<?php echo $t95_rkas2->jumlah->CellAttributes() ?>>
<span id="el<?php echo $t95_rkas2_delete->RowCnt ?>_t95_rkas2_jumlah" class="t95_rkas2_jumlah">
<span<?php echo $t95_rkas2->jumlah->ViewAttributes() ?>>
<?php echo $t95_rkas2->jumlah->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_rkas2->no_keyfield->Visible) { // no_keyfield ?>
		<td<?php echo $t95_rkas2->no_keyfield->CellAttributes() ?>>
<span id="el<?php echo $t95_rkas2_delete->RowCnt ?>_t95_rkas2_no_keyfield" class="t95_rkas2_no_keyfield">
<span<?php echo $t95_rkas2->no_keyfield->ViewAttributes() ?>>
<?php echo $t95_rkas2->no_keyfield->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_rkas2->no_level->Visible) { // no_level ?>
		<td<?php echo $t95_rkas2->no_level->CellAttributes() ?>>
<span id="el<?php echo $t95_rkas2_delete->RowCnt ?>_t95_rkas2_no_level" class="t95_rkas2_no_level">
<span<?php echo $t95_rkas2->no_level->ViewAttributes() ?>>
<?php echo $t95_rkas2->no_level->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_rkas2->nama_tabel->Visible) { // nama_tabel ?>
		<td<?php echo $t95_rkas2->nama_tabel->CellAttributes() ?>>
<span id="el<?php echo $t95_rkas2_delete->RowCnt ?>_t95_rkas2_nama_tabel" class="t95_rkas2_nama_tabel">
<span<?php echo $t95_rkas2->nama_tabel->ViewAttributes() ?>>
<?php echo $t95_rkas2->nama_tabel->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_rkas2->id_data->Visible) { // id_data ?>
		<td<?php echo $t95_rkas2->id_data->CellAttributes() ?>>
<span id="el<?php echo $t95_rkas2_delete->RowCnt ?>_t95_rkas2_id_data" class="t95_rkas2_id_data">
<span<?php echo $t95_rkas2->id_data->ViewAttributes() ?>>
<?php echo $t95_rkas2->id_data->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t95_rkas2_delete->Recordset->MoveNext();
}
$t95_rkas2_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t95_rkas2_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ft95_rkas2delete.Init();
</script>
<?php
$t95_rkas2_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t95_rkas2_delete->Page_Terminate();
?>
