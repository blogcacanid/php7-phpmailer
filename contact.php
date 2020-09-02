<?php include('header.php'); ?>
    <form method="post" action="mail_send.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="mail_to">Kepada:</label>
            <input type="text" class="form-control" name="mail_to" id="mail_to" placeholder="Enter Email Penerima" />
        </div>
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Judul Email" />
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" name="message" id="message" placeholder="Enter Isi Pesan" ></textarea>
        </div>
        <div class="form-group">
            <label for="attachment">Attachment:</label>
            <input type="file" class="form-control" name="attachment" id="attachment" />
        </div>
        <div class="form-group">        
            <button type="submit" class="btn btn-success col-sm-5"><i class="fa fa-send"></i>&nbsp;KIRIM EMAIL</button>
        </div>
    </form>
<?php include('footer.php'); ?>