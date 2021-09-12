<!-- Created by Ariful Islam at 8/30/2021 - 11:59 PM -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" referrerpolicy="no-referrer"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <title>Insurance Claim Form</title>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Medicare Insurance Member’s Application Form</h3>
        </div>
    </div>
    <hr>


        <div class="row">
            <div class="col-md-6">
                <label for="">1. Name of Employer</label>
            </div>
            <div class="col-md-6">
               <b>{{ $form->employer_name }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">2. Name of Policyholder’s</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->policy_holder_name }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">3. Designation</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->designation }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">4. ID/ PF NO.</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->pf_no }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">5. Current Address</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->current_address }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">6. Date Of Birth</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->date_of_birth }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">7.  Sex</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->sex }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">8. Marital Status</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->marital_status }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">9. No. of Children</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->no_children }}</b>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">10. Policyholder and Dependents to be included in the Plan  Mobile No</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->mobile_no }}</b>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {!! $form->dependents !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">11.  Coverage for:</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->coverage_for }}</b>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="">12.  Maternity Benefit</label>
            </div>
            <div class="col-md-6">
                <b>{{ $form->maternity_benefit }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center">Health Questionnaire</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p class="text-justify">No insurance cover will apply in respect of any condition, or linked condition, which exists, or has existed before the acceptance of risk by Meghna Life Insurance Company Limited, unless it has been declared to and accepted by Meghna Life Insurance Company Limited. It is therefore, in your interest to answer these questions fully and provide information.
                    If the answer is “Yes”, write details in the space provided below:
                </p>
                <p><b>Within the last five years, have you or any member of your family applying for insurance </b></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <label for="">(a)	been incapacitated for a period of more than 10 days as a result of any illness, injury, disability or impairment?</label>
            </div>
            <div class="col-md-4">
                <b>{{ $form->twelve_a }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <label for=""> (b)	consulted a specialist or attended a clinic as an out patient for the purpose of an investigation, test, X-ray, or operation? </label>
            </div>
            <div class="col-md-4">
                <b>{{ $form->twelve_b }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <label for=""> (c)	consulted any doctor about any condition or impairment which still exits or has left any residual effect? </label>
            </div>
            <div class="col-md-4">
                <b>{{ $form->twelve_c }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <p><b>Currently are you or any member of your family applying for insurance</b></p>
                <label for=""> (d)	receiving any medical treatment or medication, or on special diet or expecting to consult a doctor, in connection with any illness, injury, disability or impairment for which symptoms are known, evident, or suspected? </label>
            </div>
            <div class="col-md-4">
                <br>
                <b>{{ $form->twelve_d }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <p><b>At any time, have you or any member of your family applying for insurance</b></p>
                <label for=""> (e)	been postponed, declined, or accepted subject to special terms by any insurance company for life insurance policy? </label>
            </div>
            <div class="col-md-4">
                <br>
                <b>{{ $form->twelve_e }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <label for=""> (f)	is there any additional information relating to the health of you or any member of your family included in this form that you should in good faith disclose? </label>
            </div>
            <div class="col-md-4">
                <b>{{ $form->twelve_f }}</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p class="text-center font-weight-bold">If you have answered "YES" to any of the questions above then complete the next section. If the space is insufficient, please supply details separately.</p>
                <p class="font-weight-bold"> 13. DETAILED HEALTH STATEMENT </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>Details of any condition which caused incapacity for 10 days or more, and which have occurred within the last five years:</p>
                {!! $form->thirteen_a !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>Details of any conditions which have necessitated specialist consultation, or hospital attendance either as an out-patient or in-patient, and which have occurred within the last five years:</p>
                {!! $form->thirteen_b !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>Details of any conditions or impairment which still exists or has left any residual effect that has necessitated consultation with any doctor within the last five years:</p>

                {!! $form->thirteen_c !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>Details of any current medical treatment or medication, or special diet, or illness, injury, disability, or impairment for which symptoms are known, evident, or suspected:</p>
                {!! $form->thirteen_d !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>Details of any insurance application which has resulted in cover being postponed, declined, or accepted subject to special terms:</p>

                {!! $form->thirteen_e !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>Details of any additional information relating to health that you should in good faith disclose:</p>
                {!! $form->thirteen_f !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p class="font-weight-bold">14. DECLARATION</p>
                <p>I declare that the statements in this application are true and complete. This Application and declaration, together with supplementary application declarations or disclosures made by me and the Employer shall be the basis of the contract of the Plan.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="Signature">Signature</label>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/', $form->signature) }}" alt="">

            </div>
            <div class="col-md-4">
                {{ $form->date }}
            </div>
        </div>
        <br>
        <br>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>
</html>
