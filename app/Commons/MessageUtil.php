<?php
namespace app\Commons;

/**
 * メッセージ定数管理クラス
 */
class MessageUtil
{
    const TYPE_PRIMARY = 'PRIMARY';
    const TYPE_SECONDARY = 'SECONDARY';
    const TYPE_SUCCESS = 'SUCCESS';
    const TYPE_DANGER = 'DANGER';
    const TYPE_WARNING = 'WARNING';
    const TYPE_INFO = 'INFO';
    const TYPE_LIGHT = 'LIGHT';
    const TYPE_DARK = 'DARK';

    const MSG_ERR_0001 = 'ページが存在しません。';
    const MSG_ERR_0002 = 'ユーザー名または、パスワードが違います。';
    const MSG_ERR_0003 = 'セッションの有効期限切れか不正なアクセスです。';
    const MSG_ERR_0004 = 'ユーザー名または、E-Mailが入力されていません。';
    const MSG_ERR_0005 = '検索条件に該当するデータは存在しませんでした。';
    const MSG_ERR_0006 = '入力されてユーザー名は既に登録済みです。';
    const MSG_ERR_0007 = 'スーパーユーザーの権限・アカウント凍結は変更は不可です。';
    const MSG_ERR_0008 = '管理者権限を持つユーザー以外での権限・ユーザー名・アカウント凍結変更は不可です。';
    const MSG_INF_0001 = 'ログインしました。';
    const MSG_INF_0002 = 'ログアウトしました。';
    const MSG_INF_0003 = 'シリアルキーを削除しました。';
    const MSG_INF_0004 = 'シリアルを作成しました。';
    const MSG_INF_0005 = '件ヒットしました。';
    const MSG_INF_0006 = 'データを更新しました。';
    const MSG_INF_0007 = 'シリアルキーを凍結解除しました。';
    const MSG_INF_0008 = '新規ユーザーを登録しました。';
    const MSG_INF_0009 = 'ユーザー情報を変更しました。';
}