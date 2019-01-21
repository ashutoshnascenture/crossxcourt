<!--
{{ trans('quickadmin::emails.password-reset_your_password') }} {{ url('password/reset/'.$token) }}
-->

<p><b> Hi there,</b></p>

<p>Someone recently requested a password change for your CrossXcourt account. If this was you, you can set a new password here:</p>

Click here to reset your password: {{ url('password/reset/'.$token) }}

<p>If you don't want to change your password or didn't request this, just ignore and delete this message.</p>

