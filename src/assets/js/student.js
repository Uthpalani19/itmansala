function showPopup() {
    document.getElementById('rating_form').style.display = 'flex';
    document.body.classList.add('dark-background');
}

function closePopup() {
    event.preventDefault();
    document.getElementById('rating_form').style.display = 'none';
    document.body.classList.remove('dark-background');
}

var ratedIndex = -1;
$(document).ready(function(){
    resetStarColors();

    $('.fa-star').on('click',function(){
        ratedIndex = parseInt($(this).data('index'));
    });

    $('.fa-star').mouseover(function(){
        resetStarColors();

        var currentIndex = parseInt($(this).data('index'));

        for (var i=0; i<= currentIndex; i++)
        $('.fa-star:eq('+i+')').css('color',' #F39C12');
    });

    $('.fa-star').mouseleave(function(){
        resetStarColors();

        if (ratedIndex != -1)
            for (var i=0; i<= ratedIndex; i++)
                $('.fa-star:eq('+i+')').css('color',' #F39C12');
    });
});

function resetStarColors(){
    $('.fa-star').css('color','#6D6D6D')
}

//------------- rating function passing to the database -------------------------------------//
$(document).ready(function() {
    $('#submit-btn').click(function() {

        var rating = ratedIndex + 1;
        var reviewMessage = $('#review-message').val();

        $.ajax({
            type: 'POST',
            data: {
                rating: rating,
                reviewMessage: reviewMessage
            },
            success: function(response) {
                alert("You have successfully added your review!"); // show a success message
                $('#rating_form').hide(); // hide the popup
                document.body.classList.remove('dark-background');
                document.getElementById('submit-btn').style.display = 'none';
            },
            error: function(xhr, status, error) {
                alert("There was an error adding your review. Please try again later."); // show an error message
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });
});





















