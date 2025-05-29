<div class="d-flex flex-wrap justift-content-around">


</div>
<div class="lst">

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "membros/lista.php",
            method: 'post',
            data: {},
            dataType: 'html',
            success: function(lst) {
                $('.lst').html(lst)
            }
        })
    })
</script>