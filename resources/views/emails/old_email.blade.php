<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body bgcolor="#8d8e90">
<div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90" style="margin: 20px">
        <tr bgcolor="#fffff" style="margin: 10px;">
            <td align="left"><img src="{!! $message->embed($logopath) !!}"></td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="margin: 20px">
        <tr>
            <td align="left" valign="top" style="padding:10px;">{!! $content !!}</td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90"
           style="border-top:2px solid #DC1869; margin: 20px">
        <tr bgcolor="#F9F9F9" style="height: 40px;">
            <td>{!! $footer !!}<a href="{!! $sitepath !!}" target="_blank">{!! $sitename !!}</a></td>
        </tr>
    </table>

</div>
</body>
</html>
