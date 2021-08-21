<div class="container border border-top-0 mt-5 shadow-sm">
    <?php echo $sub_form['sub_form_export']; ?>
</div>

<script>
    $(document).ready(function() {
        var preview = $("fieldset").contents()
        $(".form-border").replaceWith(preview)
    });
</script>