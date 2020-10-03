<div class="container border border-top-0 mt-5 shadow-sm">
    <?php echo $form['form_export']; ?>
</div>

<script>
    $(document).ready(function() {
        var preview = $("fieldset").contents()
        $(".form-border").replaceWith(preview)
    });
</script>