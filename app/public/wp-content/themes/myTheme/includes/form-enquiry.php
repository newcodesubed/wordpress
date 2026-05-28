<div id="success-message" class="alert alert-success" style="display:none">

</div>

<form id="enquiry">
    <h2>Enquiry Form <?php echo get_the_title(); ?></h2>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit Enquiry</button>
</form>

<script>

    (function($){

        $('#enquiry').submit(function(e){
            e.preventDefault();
            var endpoint = '<?php echo admin_url('admin-ajax.php'); ?>';

            var form = $('#enquiry').serialize();
            
            var formData = new FormData();

            formData.append('action', 'enquiry');
            formData.append('enquiry', form);

            $.ajax({
                url: endpoint,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    $('#enquiry').fadeOut(200);
                    
                    $('#success-message').text(response.data).fadeIn(200);

                    $('#enquiry').trigger('reset');

                    $('#enquiry').fadeIn(200);
                },
                error: function(xhr, status, error){
                    alert('An error occurred while submitting the enquiry. Please try again.');
                }

            });
        })

    })(jQuery);




</script>
