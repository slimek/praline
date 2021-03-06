<?php
namespace Praline\Error;

// 傳回給客戶端的錯誤代碼
// - Praline 使用的 error codes 皆為負數，應用程式請使用正數
class ErrorCode
{
    // 如果是由 PHP 系統或第三方套件擲出的 Throwable，code 通常是這個值
    public const UNKNOWN = 0;

    //------------------------------------------------------------------------------------------------------------------
    // User Error
    // - 由使用者行為造成的錯誤
    //------------------------------------------------------------------------------------------------------------------

    // 登入身份驗證失敗
    public const PERMISSION_DENIED = -1;

    // 短時間內嘗試登入次數太多，暫時不允許登入
    public const LOGIN_THROTTLED = -2;

    // Session 未找到 - 可能是 access token 已經過期，請玩家重新登入即可
    public const SESSION_NOT_FOUND = -3;

    //------------------------------------------------------------------------------------------------------------------
    // Bad Request
    // - Client 側程式錯誤，通常是 request 的參數格式不正確之類的問題。
    //------------------------------------------------------------------------------------------------------------------

    // 尚未驗證身份。通常是因為尚未經過 Authentication 驗證就呼叫需要授權的 API
    public const NOT_AUTHORIZED = -11;

    // 缺少必要的 Request 參數
    public const MISSING_PARAMETER = -12;

    // Request 參數格式不正確
    public const INVALID_PARAMETER = -13;

    // 缺少必要的 Request Header
    public const MISSING_HEADER = -14;

    // 相同的要求正在處理中
    // - 這種錯誤很少見，只發生在伺服器處理要求耗時太久（等待 I/O、死結等），還沒處理完 client 側就又重發相同要求的時候
    public const REQUEST_CONFLICT = -15;

    // 身份憑證無效
    // - 用於程式自動登入（無須玩家輸入資訊）、但驗證卻失敗的時候
    public const INVALID_CREDENTIAL = -16;
}
