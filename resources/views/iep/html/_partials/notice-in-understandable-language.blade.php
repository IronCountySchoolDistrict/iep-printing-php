<div class="row">
    <div class="col-xs-12 box">
        <span class="text-bold">Notice in Understandable Language:</span>
        <p>Federal regulations require that parents and adult students be provided prior notice in their native language or other mode of communication each time the LEA proposes or refuses to initiate or change the identification, evaluation, or educational placement of your child/you or the provision of a free appropriate public education (FAPE) to your child/you, or upon conducting a manifestation determination.</p>
        <br />
        <p>If the native language or other mode of communication of the parent/adult student is not a written language:</p>
        <p>
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('notice-translated'), 'needle' => 'The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication on:']) The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication
            on: <span class="underline">{{ (!empty($responses->get('communication-on'))) ? $responses->get('communication-on') : str_repeat('&nbsp;', 50) }}</span>
            by: <span class="underline">{{ (!empty($responses->get('communication-by'))) ? $responses->get('communication-by') : str_repeat('&nbsp;', 50) }}</span>
        </p>
        <p>
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('adult-understands'), 'needle' => 'Parent/adult student verify to the translator that he/she understands the content of this notice']) Parent/adult student verify to the translator that he/she understands the content of this notice.
        </p>

        <div class="row">
            <div class="col-xs-7">
                <div class="right underline left-input">
                    <span></span>
                </div>
            </div>
            <div class="col-xs-4 col-xs-offset-1">
                <div class="right underline center-input">
                    <span>{{ $responses->get('sign-of-interpreter-date') }}</span>
                </div>
            </div>
            <div class="col-xs-7">
                <div class="left" style="width: 175pt">
                    <span>Signature of Interpreter, if used</span>
                </div>
                <div class="right text-right">
                    <span><small>{{ $responses->get('sign-of-interpreter') }}</small></span>
                </div>
            </div>
            <div class="col-xs-4 col-xs-offset-1">
                <div class="left">
                    <span>Date</span>
                </div>
            </div>
        </div>
    </div>
</div>
