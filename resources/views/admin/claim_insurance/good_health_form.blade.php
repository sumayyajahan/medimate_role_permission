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

    <form  class="form-group" action="{{route('health-statement.submit')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="enroll_id" value="{{ $enroll->id }}">

    <div class="row">
        <div class="col-md-6">
            <label for="">1. Name of Employer</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="employer_name">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">2. Name of Policyholder’s</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="policy_holder_name">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">3. Designation</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="designation">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">4. ID/ PF NO.</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="pf_no">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">5. Current Address</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="current_address">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">6. Date Of Birth</label>
        </div>
        <div class="col-md-6">
            <input type="date" class="form-control" name="date_of_birth">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">7.  Sex</label>
        </div>
        <div class="col-md-6">
            <select name="sex" id="" class="form-control">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">8. Marital Status</label>
        </div>
        <div class="col-md-6">
            <select name="marital_status" id="" class="form-control">
                <option value="Married">Married</option>
                <option value="Unmarried">Unmarried</option>
                <option value="Divorce/Others">Divorce/Others</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">9. No. of Children</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="no_children">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">10. Policyholder and Dependents to be included in the Plan  Mobile No</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="mobile_no">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <textarea name="dependents" id="" cols="30" rows="10" class="summernote">
                <table class="table table-bordered"><tbody><tr><td>Name</td><td>Plan</td><td>Date of Birth</td><td>Sex</td><td>Relationship</td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr></tbody></table>
            </textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">11.  Coverage for:</label>
        </div>
        <div class="col-md-6">
            <select name="coverage_for" id="" class="form-control">
                <option value="Self">Self</option>
                <option value="Spouse">Spouse</option>
                <option value="Family(Spouse & Children)">Family(Spouse & Children</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="">12.  Maternity Benefit</label>
        </div>
        <div class="col-md-6">
            <select name="maternity_benefit" id="" class="form-control">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
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
                <select name="twelve_a" id="" class="form-control">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <label for=""> (b)	consulted a specialist or attended a clinic as an out patient for the purpose of an investigation, test, X-ray, or operation? </label>
            </div>
            <div class="col-md-4">
                <select name="twelve_b" id="" class="form-control">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <label for=""> (c)	consulted any doctor about any condition or impairment which still exits or has left any residual effect? </label>
            </div>
            <div class="col-md-4">
                <select name="twelve_c" id="" class="form-control">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <p><b>Currently are you or any member of your family applying for insurance</b></p>
                <label for=""> (d)	receiving any medical treatment or medication, or on special diet or expecting to consult a doctor, in connection with any illness, injury, disability or impairment for which symptoms are known, evident, or suspected? </label>
            </div>
            <div class="col-md-4">
                <br>
                <select name="twelve_d" id="" class="form-control">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <p><b>At any time, have you or any member of your family applying for insurance</b></p>
                <label for=""> (e)	been postponed, declined, or accepted subject to special terms by any insurance company for life insurance policy? </label>
            </div>
            <div class="col-md-4">
                <br>
                <select name="twelve_e" id="" class="form-control">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <label for=""> (f)	is there any additional information relating to the health of you or any member of your family included in this form that you should in good faith disclose? </label>
            </div>
            <div class="col-md-4">
                <select name="twelve_f" id="" class="form-control">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
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
                <textarea name="thirteen_a" id="" cols="30" rows="10" class="summernote">
                    <p>Details of any condition which caused incapacity for 10 days or more, and which have occurred within the last five years:</p>
                    <table class="table table-bordered"><tbody><tr><td>Name</td><td>Date</td><td>Reason</td><td>Current Situation</td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr></tbody></table>
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <textarea name="thirteen_b" id="" cols="30" rows="10" class="summernote">
                    <p>Details of any conditions which have necessitated specialist consultation, or hospital attendance either as an out-patient or in-patient, and which have occurred within the last five years:</p>
                    <table class="table table-bordered"><tbody><tr><td>Name</td><td>Date</td><td>Reason</td><td>Current Situation</td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr></tbody></table>
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <textarea name="thirteen_c" id="" cols="30" rows="10" class="summernote">
                    <p>Details of any conditions or impairment which still exists or has left any residual effect that has necessitated consultation with any doctor within the last five years:</p>
                    <table class="table table-bordered"><tbody><tr><td>Name</td><td>Date</td><td>Reason</td><td>Current Situation</td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr></tbody></table>
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <textarea name="thirteen_d" id="" cols="30" rows="10" class="summernote">
                    <p>Details of any current medical treatment or medication, or special diet, or illness, injury, disability, or impairment for which symptoms are known, evident, or suspected:</p>
                    <table class="table table-bordered"><tbody><tr><td>Name</td><td>Date</td><td>Reason</td><td>Current Situation</td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr></tbody></table>
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <textarea name="thirteen_e" id="" cols="30" rows="10" class="summernote">
                    <p>Details of any insurance application which has resulted in cover being postponed, declined, or accepted subject to special terms:</p>
                    <table class="table table-bordered"><tbody><tr><td>Name</td><td>Date</td><td>Reason</td><td>Current Situation</td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr></tbody></table>
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <textarea name="thirteen_f" id="" cols="30" rows="10" class="summernote">
                    <p>Details of any additional information relating to health that you should in good faith disclose:</p>
                    <table class="table table-bordered"><tbody><tr><td>Name</td><td>Date</td><td>Reason</td><td>Current Situation</td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr></tbody></table>
                </textarea>
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
                <input type="file" name="signature">
            </div>
            <div class="col-md-4">
                <input type="date" class="form-control" name="date">
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 pull-right">
                <input type="submit" name="submit" value="Submit Health Statement" class="btn btn-success pull-right">
            </div>
        </div>

        <hr>
        <br>


    </form>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>

</body>
</html>
