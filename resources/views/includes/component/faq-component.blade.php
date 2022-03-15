<div class="faq-section opening-block">
    <div class="faq-question">
        <i class="fas fa-chevron-right fa-sm faq-icon" id="questionArrow{{ $id }}" onclick="displayAnswer(document.getElementById(this.id), document.getElementById(this.parentElement.nextElementSibling.id))"></i>
        {{ $question }}
    </div>
    <div class="faq-answer hidden" id="answerBlock{{ $id }}">
        {{ $answer }}
    </div>
</div>
