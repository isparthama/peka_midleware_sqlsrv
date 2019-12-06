<table border="0" width="100%" style="border-collapse:collapse">
    <tr><td>Dengan Hormat,</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Terima kasih, laporan PEKA Observasi anda telah diterima dengan informasi sebagai berikut: </td></tr>
    <tr>
        <td>
            <table border="0" width="100%" style="border-collapse:collapse">
                <tr>
                    <td width="20%">Nomor Observasi ID</td>
                    <td width="1%">:</td>
                    <td width="79%"><?php echo e($Nomor_Observasi_ID); ?></td>
                </tr>
                <tr>
                    <td width="20%">Tanggal Pengamatan</td>
                    <td width="1%">:</td>
                    <td width="79%"><?php echo e($Tanggal_Pengamatan); ?></td>
                </tr>
                <tr>
                    <td>Pengamatan</td>
                    <td>:</td>
                    <td><?php echo e($Pengamatan); ?></td>
                </tr>
                <tr>
                    <td>Nama Pelapor</td>
                    <td>:</td>
                    <td><?php echo e($Nama_Pelapor); ?></td>
                </tr>
                <tr>
                    <td>Fungsi</td>
                    <td>:</td>
                    <td><?php echo e($Fungsi); ?></td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td><?php echo e($Lokasi); ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr><td>This is an automated generated email message from PEKA PEPC application, please do not reply to this email.</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Untuk melihat detail permintaan anda silahkan klik <a href="http://localhost:8000/ticketing/request/view_data/<?php echo e($Nomor_Observasi_ID); ?>" target="_blank">LINK</a> ini</td></tr>
</table>
<?php /**PATH C:\xampp\htdocs\peka_midleware_sqlsrv\resources\views/notif_email_request.blade.php ENDPATH**/ ?>