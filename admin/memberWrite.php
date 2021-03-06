<?php
	include_once $_SERVER["DOCUMENT_ROOT"].'/_common/config.php';
	include_once $_SERVER["DOCUMENT_ROOT"].'/_common/function.php';
	include_once $_SERVER["DOCUMENT_ROOT"].'/_common/classes/DBConnMgr.class.php';
	
	// validation 체크를 따로 안할 경우 빈 배열로 선언
	//$valueValid = [];
	$valueValid = [
		'idx' => ['type' => 'string', 'notnull' => true, 'default' => '', 'min' => 0, 'max' => 3],
		'userId' => ['type' => 'string', 'notnull' => true, 'default' => '', 'min' => 2, 'max' => 20]
	];
	
	$totalRecords	= 0;		// 총 레코드 수
	$recordsPerPage	= 10;		// 한 페이지에 보일 레코드 수
	$pagePerBlock	= 10;		// 한번에 보일 페이지 블럭 수
	$currentPage	= 1;		// 현재 페이지

	$sql = ' SELECT ';
	$sql .= ' (SELECT COUNT(*) FROM [theExam].[dbo].[Adm_info] ) AS totalRecords ';
	$sql .= ' , Adm_id, Adm_name, Adm_Email, Reg_day, Login_day, Password_day ';
	$sql .= ' FROM [theExam].[dbo].[Adm_info] ';
	$sql .= ' ORDER BY Reg_day DESC ';
	$sql .= ' OFFSET ( '.$currentPage.' - 1 ) * '.$recordsPerPage.' ROWS ';
	$sql .= ' FETCH NEXT '.$recordsPerPage.' ROWS ONLY ';

	$dbConn = new DBConnMgr(DB_DRIVER, DB_USER, DB_PASSWD); // DB커넥션 객체 생성
	$arrRows = $dbConn->fnSQLPrepare($sql, $pArray, ''); // 쿼리 실행

	if ( count($arrRows) > 0 ){
		$totalRecords	= $arrRows[0][totalRecords];
	}

?>
<?php
	require_once $_SERVER["DOCUMENT_ROOT"].'/common/template/head.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/common/template/header.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/common/template/left.php';
?>
<body>
<form action="" method="post"> 
<fieldset> 

<!--right -->
<div id="right_area">
	<div class="wrap_contents">
		<div class="wid_fix"> 
			<h3 class="title">계정관리</h3>
			<!-- 세로형 테이블 -->
			<div class="box_bs">
				<div class="wrap_tbl">
					<table class="type02">
						<caption></caption>
						<colgroup>
							<col style="width:180px">
							<col style="width:auto">
							<col style="width:180px">
							<col style="width:auto">
						</colgroup>
						<tbody>
							<tr>
								<th>아이디</th>
								<td colspan="3">
									<div class="item">
										<input type="text" name="" id="" style="width:20%" placeholder="">
									</div>
								</td>
							</tr>
							<tr>
								<th>비밀번호</th>
								<td colspan="3">
									<div class="item">
										<input type="text" name="" id="" style="width:20%" placeholder="">
									</div>
								</td>
							</tr>
							<tr>
								<th>이름</th>
								<td colspan="3">
									<div class="item">
										<input type="text" name="" id="" style="width:20%" placeholder="">
									</div>
								</td>
							</tr>
							<tr>
								<th>eToken</th>
								<td colspan="3">
									<div class="item">
										<input type="text" name="" id="" style="width:20%" placeholder="">
									</div>
								</td>
							</tr>
							<tr>
								<th>이메일</th>
								<td colspan="3">
									<div class="item">
										<input type="text" name="" id="" style="width:20%" placeholder="">
										@
										<select style="width:48%">  
											<option>선택하세요</option> 
											<option>선택 둘</option> 
											<option>선택 셋</option> 
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<th>전화번호</th>
								<td colspan="3">
									<div class="item">
										<input type="text" name="" id="" style="width:20%" placeholder=""> -
										<input type="text" name="" id="" style="width:20%" placeholder=""> -
										<input type="text" name="" id="" style="width:20%" placeholder="">
									</div>
								</td>
							</tr>
							<tr>
								<th>소속회사/부서</th>
								<td colspan="3">
									<div class="item">
										<select style="width:48%">  
											<option>선택하세요</option> 
											<option>선택 둘</option> 
											<option>선택 셋</option> 
										</select>
										<select style="width:48%">  
											<option>선택하세요</option> 
											<option>선택 둘</option> 
											<option>선택 셋</option> 
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<th>컴퓨터 IP</th>
								<td colspan="3">
									<div class="item">
										<input type="text" name="" id="" style="width:20%" placeholder="">
									</div>
								</td>
							</tr>
							<tr>
								<th>개인정보 권한</th>
								<td colspan="3">
									<div class="item">
										<input type="radio" name="" id="yes" class="i_unit"><label for="yes">부여</label>
										<input type="radio" name="" id="no" class="i_unit"><label for="no">부여안함</label>
									</div>
								</td>
							</tr>
							<tr>
								<th>결제 권한</th>
								<td colspan="3">
									<div class="item">
										<input type="radio" name="" id="yes" class="i_unit"><label for="yes">부여</label>
										<input type="radio" name="" id="no" class="i_unit"><label for="no">부여안함</label>
									</div>
								</td>
							</tr>
							<tr>
								<th>사용여부</th>
								<td colspan="3">
									<div class="item">
										<input type="radio" name="" id="yes" class="i_unit"><label for="yes">사용</label>
										<input type="radio" name="" id="no" class="i_unit"><label for="no">사용안함</label>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="wrap_btn">
					<button type="button" class="btn_fill btn_lg">등록</button>
					<button type="button" class="btn_line btn_lg">취소</button>
				</div>

			</div>
			<!-- 세로형 테이블 //-->
		</div>
	</div>
</div>
<!--right //-->

<?php
	require_once $_SERVER["DOCUMENT_ROOT"].'/common/template/footer.php';
?>
