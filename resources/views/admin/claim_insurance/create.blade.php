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

    <title>Insurance Claim Form</title>
</head>

<body>

<div class="container">
    <h1 class="text-center">HEALTH INSURANCE CLAIM FORM</h1>
    <b><u>স্বাস্থ্য বীমা দাবী ফর্ম</u></b>
    <form  class="form-group" action="{{route('claim-insurance.submit')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="enroll_id" value="{{ $enroll->id }}">

        <div class="row mb-4">
            <div class="col-md-6">
                <b><u>HEALTH INSURANCE CLAIM FORM</u></b>
            </div>
            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-md-4"><label for="">Type Of Insurance</label></div>
                    <div class="col-md-8">
                        <select name="insurance_type" id="insurance_type" class="form-control">
                            <option>Choose...</option>
                            <option value="Individual(এককবীমা)">Individual(এককবীমা)</option>
                            <option value="Group(গোষ্ঠীবীমা)">Group(গোষ্ঠীবীমা)</option>
                            <option value="Others(অন্যান্য)">Others(অন্যান্য)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <tbody>
            <div class="row">
                <div class="col-md-6">
                    <label for="claimType">Claim Type(বীমা দাবীরধরন):</label>
                </div>
                <div class="col-md-6">
                    <select class="custom-select" id="inputGroupSelect01" name="claim_type">
                        <option selected>Choose...</option>
                        <option value="Outpatient(বর্হিবিভাগ)">Outpatient(বর্হিবিভাগ)</option>
                        <option value="General(সাধারনচক্ষু)">General(সাধারনচক্ষু)</option>
                        <option value="Optical()">Optical()</option>
                        <option value="Dental(দন্ত)">Dental(দন্ত)</option>
                        <option value="In-patient(ভর্তিকালীন)">In-patient(ভর্তিকালীন)</option>
                        <option value="Hospitalization(হাসপাতালে ভর্তি)">Hospitalization(হাসপাতালে ভর্তি)</option>
                        <option value="Maternity(প্রসুতি)">Maternity(প্রসুতি)</option>
                    </select>
                </div>
            </div>
            <!-- <div id="individual"> -->
            <div class="row" id="individual1">
                <div class="col-md-6">
                    <label for="policyNo">Policy No/Member ID(সদস্য নম্বর):</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="member_id" class="form-control" value="{{ $enroll->user_id }}">
                </div>
            </div>
            <div class="row" id="individual2">
                <div class="col-md-6">
                    <label for="">Name of Insured(বীমাকারীরনাম):</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="insured_name" class="form-control">
                </div>
            </div>
            <div class="row" id="individual3">
                <div class="col-md-6">
                    <label for="">Name of Patient(রোগীরনাম):</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="patient_name" class="form-control">
                </div>
            </div>
            <!-- </div> -->
            <!-- <div id="organization"> -->
            <div class="row" id="organization1">
                <div class="col-md-6">
                    <label for="">Name of Organization(প্রতিষ্ঠানেরনাম):</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="org_name" class="form-control">
                </div>
            </div>

            <div class="row" id="organization2">
                <div class="col-md-6">
                    <label for="">Mobile No(মোবাইল  নম্বর):</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="org_mobile" class="form-control">
                </div>
            </div>
            <div class="row" id="organization3">
                <div class="col-md-6">
                    <label for="">Alternative Mobile No(বিকল্প মোবাইল নম্বর):</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="org_mobile_alt" class="form-control">
                </div>
            </div>
            <!-- </div> -->
            <div class="row">
                <div class="col-md-6">
                    <label for="Relation">Relation with Insured(বীমাকারীর সাথে সম্পর্ক):</label>
                </div>
                <div class="col-md-6">
                    <select class="custom-select" id="inputGroupSelect01" name="relation_with_insured">
                        <option selected>Choose...</option>
                        <option value="Own(নিজ)">Own(নিজ)</option>
                        <option value="Husband(স্বামী)">Husband(স্বামী)</option>
                        <option value="Wife(স্ত্রী)">Wife(স্ত্রী)</option>
                        <option value="Son(পুত্র)">Son(পুত্র)</option>
                        <option value="Daughter(কন্যা)">Daughter(কন্যা)</option>
                        <option value="Father(পিতা)">Father(পিতা)</option>
                        <option value="Mother(মাতা)">Mother(মাতা)</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Name of Hospital/Clinic(হাসপাতাল/ক্লিনিকের নাম):</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="hospital_name" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Area(এলাকা):</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="hospital_area" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Date of Admission(ভর্তির তারিখ):</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="admission_date" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Date of Discharge(ছুটির/হাসপাতাল ত্যাগের তারিখ):</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="discharge_date" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center font-weight-bold">Breakup of Treatment Expenses (চিকিৎসা খরচের বিস্তারিত বিবরণ)</div>
            </div>

            <div class="row">
                <div class="col-md-6">খরচের খাত /Cost Heads / Titles </div>
                <div class="col-md-6">টাকার পরিমান / Amounts (Taka) </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label for="">কেবিন/সিট/বিছানা ভাড়া:/Hospital Accommodation Charge:</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="accommodation_charge" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">ডাক্তার ফি:/ Consultation fee: </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="doctor_fee" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">পরীক্ষা-নিরীক্ষা খরচ: /  Medical Investigation Expense: </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="test_fee" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">ঔষধপত্র: /  Medicines: </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="medicine_cost" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">অপারেশনের খরচ: / Surgical Expense:  </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="surgical_cost" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">আনুষাঙ্গিক চিকিৎসা খরচ: / Ancillary Services fee:  </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="ancillary_fee" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">অন্যান্য খরচ (যদি থাকে): /  Other Expenses (if any): </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="other_expenses" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">ডিসকাউন্ট: /  Discount: </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="discount" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">মোট দাবীর পরিমান: /  Total Claim Amount: </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="claim_amount" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">ব্যাংক হিসাব সংক্রান্ত তথ্য/Accounts related Information:</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Account Name(ব্যাংক হিসাবের নাম): </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="ac_name" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Account Number(হিসাব নম্বর): </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="ac_no" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Bank Name & Branch(ব্যাংকের নাম ও শাখা): </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="bank_name" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Routing Number(রাউটিং নম্বর): </label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="routing_number" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">ক্ষমতার্পণ(Authorization)</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>I hereby certify that the foregoing statements are fully and true to the best my knowledge and I hereby authorize all to provide Alpha IslamiLife Insurance Limited. Any copy of this authorization shall be taken as original.
                    </p>
                    <p>আমি এতদ্বারা প্রত্যয়ন করছি যে, উপরোক্ত বিবৃতিসমূহ আমার সর্বোচ্চ জ্ঞানমতে পূর্ণাঙ্গ ও সত্য এবংএতদ্বারা সকল সংযুক্ত নথিপত্রের অনুলিপি আছে তা আলফা ইসলামীলাইফ ইন্স্যুরেন্স লিমিটেড কে সরবরাহ করার ক্ষমতা প্রদান করছি। এই ক্ষমতার্পণের
                        যে কোন অনুলিপি মূল দলিল বলে গণ্য হবে।</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">স্বাক্ষর(Signature)</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Signature of the Employee
                        with date & Seal(দাবীকারীর স্বাক্ষর ও তারিখ): </label>
                </div>
                <div class="col-md-6">
                  <input type="file" name="signature_employee" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Signature of the Coordinator
                        with date & Seal(সমন্বয়কের স্বাক্ষর ও তারিখ): </label>
                </div>
                <div class="col-md-6">
                    <input type="file" name="signature_coordinator" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Signature of Authorized Officer
                        with date & Seal(ভারপ্রাপ্তকর্মকর্তারস্বাক্ষর ও তারিখ): </label>
                </div>
                <div class="col-md-6">
                  <input type="file" name="signature_officer" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">সঠিকভাবে পূরনকৃত এই ফর্মের সাথে নিম্নলিখিতকাগজপত্র সংযুক্ত করুন/ Please attach following documents along with duly filled out this claim Form</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-unstyled">
                        <li>
                            ১. হাসপাতালে ভর্তিরপরামর্শ দাতাচিকিৎসকের প্রেসক্রিপশনেরঅনুলিপি। Copy of Prescriptions containing Hospitalization advice of respective physician
                        </li>
                        <li>
                            ২. মোট দাবীকৃত বিলেরসংশ্লিষ্টসকল (বিছানাভাড়া, ঔষধপত্র, চিকিৎসকফি, পরীক্ষা-নিরীক্ষা, অস্ত্রপাচার ইত্যাদি) খরচের বিস্তারিত পরিমান উল্লেখসহ মূলরশিদ।ডাটাবেস অথবা সফটওয়ার জেনারেটেডবিল ভাউচার অধিক গ্রহনযোগ্য। Original and itemized Bills / Receipts of all relevant
                            expenses i.e. Hosp. Accommodation, medicines, consultation fees, investigations, procedures, Surgery, any medical or surgical items along with their requisition slip. Database bills is preferred.
                        </li>
                        <li>
                            ৩. হাসপাতালের ছাড়পত্রের অনুলিপিসহ সকল পরীক্ষা-নিরীক্ষার রিপোর্টের অনুলিপি। Copy of Discharge Certificate, all investigations report and others treatment record.
                        </li>
                        <li>
                            ৪. অনুগ্রহকরে ডাটাবেস বা সফটওয়্যার প্রদত্ত বিস্তারিত বিলের মূলকপি প্রেরন করতেহবে। অন্যথায়, বীমা কোম্পানীকেই হাসপাতাল থেকে বিস্তারিতবিল সংগ্রহ করতে হবে যা দাবী নিষ্পত্তি সময় দীর্ঘায়িত করতেপারে। অনুগ্রহ করে বিল পরিবর্তনের উদ্দেশ্যে নিজে বা অন্য কারো মাধ্যমে
                            বিলের কপিতে যে কোন প্রকার লিখা বা ঘষা-মাজা এড়িয়ে চলুন। হাসপাতাল ত্যাগের তারিখ থেকে অনুমোদিত সময়সীমা এরমধ্যে বীমা দাবী জমাদিন। স্ব-হস্তে লিখিত বা ফটোকপি বিলবিবেচনাধীন হবেনা। Please collect database or software generated
                            Original bill details, Itemized or break down bill from hospital where available in case reimbursement. Otherwise we have to collect it and claim settlement time will be longer. Please avoid Overwriting or writing by
                            self or any other way of changing the bill. Submit your claim within allowable time limit from date of discharge. Photocopy money receipt or self-written money receipt will be out of consideration.

                        </li>
                        <li>
                            ৫. আলফা ইসলামীলাইফ প্রয়োজন অনুযায়ী দাবী সংশ্লিষ্ট যে কোন নথিপত্র তদন্ত ও তলবকরার অধিকার সংরক্ষনকরে। Alpha Islami Life reserved rights to verify or ask any documents relevant with the claims.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6" colspan="2">
                    <input type="submit" value="Submit Claim Form" name="submit" class="btn btn-success">
                </div>
            </div>

            </tbody>
        </table>
    </form>
</div>

<script>
    $(document).ready(function() {
        $("#individual1, #individual2, #individual3").hide();
        $("#organization1, #organization2, #organization3").hide();
        $("#insurance_type").on('change', function() {
            let ins_type = $(this).val();
            if (ins_type == "Individual(এককবীমা)") {
                $("#individual1, #individual2, #individual3").show('slow');
                $("#organization1, #organization2, #organization3").hide('slow');
            } else if (ins_type == "Group(গোষ্ঠীবীমা)" || ins_type == "Others(অন্যান্য)") {
                $("#individual1, #individual2, #individual3").hide('slow');
                $("#organization1, #organization2, #organization3").show('slow');
            } else {
                $("#individual1, #individual2, #individual3").hide();
                $("#organization1, #organization2, #organization3").hide();
            }
        })
    });
</script>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>


</html>
