<!-- Created by Ariful Islam at 8/24/2021 - 4:29 AM -->
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

        <div class="row mb-4">
            <div class="col-md-6">
                <b><u>HEALTH INSURANCE CLAIM FORM</u></b>
            </div>
            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-md-4"><label for="">Type Of Insurance</label></div>
                    <div class="col-md-8">
                        {{ $claim->insurance_type }}
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>
                    <label for="claimType">Claim Type(বীমা দাবীরধরন):</label>
                </td>
                <td>
                   {{ $claim->claim_type }}
                </td>
            </tr>
            <!-- <div id="individual"> -->
            <tr id="individual1">
                <td>
                    <label for="policyNo">Policy No/Member ID(সদস্য নম্বর):</label>
                </td>
                <td>
                    {{ $claim->member_id }}
                </td>
            </tr>
            <tr id="individual2">
                <td>
                    <label for="">Name of Insured(বীমাকারীরনাম):</label>
                </td>
                <td>
                    {{ $claim->insured_name }}
                </td>
            </tr>
            <tr id="individual3">
                <td>
                    <label for="">Name of Patient(রোগীরনাম):</label>
                </td>
                <td>
                    {{ $claim->patient_name }}
                </td>
            </tr>
            <!-- </div> -->
            <!-- <div id="organization"> -->
            <tr id="organization1">
                <td>
                    <label for="">Name of Organization(প্রতিষ্ঠানেরনাম):</label>
                </td>
                <td>
                    {{ $claim->org_name }}
                </td>
            </tr>

            <tr id="organization2">
                <td>
                    <label for="">Mobile No(মোবাইল  নম্বর):</label>
                </td>
                <td>
                    {{ $claim->org_mobile }}
                </td>
            </tr>
            <tr id="organization3">
                <td>
                    <label for="">Alternative Mobile No(বিকল্প মোবাইল নম্বর):</label>
                </td>
                <td>
                    {{ $claim->org_mobile_alt }}
                </td>
            </tr>
            <!-- </div> -->
            <tr>
                <td>
                    <label for="Relation">Relation with Insured(বীমাকারীর সাথে সম্পর্ক):</label>
                </td>
                <td>
                    {{ $claim->relation_with_insured }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Name of Hospital/Clinic(হাসপাতাল/ক্লিনিকের নাম):</label>
                </td>
                <td>
                    {{ $claim->hospital_name }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Area(এলাকা):</label>
                </td>
                <td>
                    {{ $claim->hospital_area }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Date of Admission(ভর্তির তারিখ):</label>
                </td>
                <td>
                    {{ $claim->admission_date }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Date of Discharge(ছুটির/হাসপাতাল ত্যাগের তারিখ):</label>
                </td>
                <td>
                    {{ $claim->discharge_date }}
                </td>
            </tr>
            <tr>
                <th colspan="2">Breakup of Treatment Expenses(চকিৎসা খরচের বিস্তারিত বিবরণ)</th>
            </tr>
            <tr>
                <th>খরচের খাত /Cost Heads / Titles </th>
                <th>টাকার পরিমান / Amounts (Taka) </th>
            </tr>
            <tr>
                <td>
                    <label for="">কেবিন/সিট/বিছানা ভাড়া:/Hospital Accommodation Charge:</label>
                </td>
                <td>
                    {{ $claim->accommodation_charge }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">ডাক্তার ফি:/ Consultation fee: </label>
                </td>
                <td>
                    {{ $claim->doctor_fee }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">পরীক্ষা-নিরীক্ষা খরচ: /  Medical Investigation Expense: </label>
                </td>
                <td>
                    {{ $claim->test_fee }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">ঔষধপত্র: /  Medicines: </label>
                </td>
                <td>
                    {{ $claim->medicine_cost }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">অপারেশনের খরচ: / Surgical Expense:  </label>
                </td>
                <td>
                    {{ $claim->surgical_cost }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">আনুষাঙ্গিক চিকিৎসা খরচ: / Ancillary Services fee:  </label>
                </td>
                <td>
                    {{ $claim->ancillary_fee }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">অন্যান্য খরচ (যদি থাকে): /  Other Expenses (if any): </label>
                </td>
                <td>
                    {{ $claim->other_expenses }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">ডিসকাউন্ট: /  Discount: </label>
                </td>
                <td>
                    {{ $claim->discount }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">মোট দাবীর পরিমান: /  Total Claim Amount: </label>
                </td>
                <td>
                    {{ $claim->claim_amount }}
                </td>
            </tr>
            <tr>
                <th colspan="2">ব্যাংক হিসাব সংক্রান্ত তথ্য/Accounts related Information:</th>
            </tr>
            <tr>
                <td>
                    <label for="">Account Name(ব্যাংক হিসাবের নাম): </label>
                </td>
                <td>
                    {{ $claim->ac_name }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Account Number(হিসাব নম্বর): </label>
                </td>
                <td>
                    {{ $claim->ac_no }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Bank Name & Branch(ব্যাংকের নাম ও শাখা): </label>
                </td>
                <td>
                    {{ $claim->bank_name }}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Routing Number(রাউটিং নম্বর): </label>
                </td>
                <td>
                    {{ $claim->routing_number }}
                </td>
            </tr>
            <tr>
                <th colspan="2">ক্ষমতার্পণ(Authorization)</th>
            </tr>
            <tr>
                <td colspan="2">
                    <p>I hereby certify that the foregoing statements are fully and true to the best my knowledge and I hereby authorize all to provide Alpha IslamiLife Insurance Limited. Any copy of this authorization shall be taken as original.
                    </p>
                    <p>আমি এতদ্বারা প্রত্যয়ন করছি যে, উপরোক্ত বিবৃতিসমূহ আমার সর্বোচ্চ জ্ঞানমতে পূর্ণাঙ্গ ও সত্য এবংএতদ্বারা সকল সংযুক্ত নথিপত্রের অনুলিপি আছে তা আলফা ইসলামীলাইফ ইন্স্যুরেন্স লিমিটেড কে সরবরাহ করার ক্ষমতা প্রদান করছি। এই ক্ষমতার্পণের
                        যে কোন অনুলিপি মূল দলিল বলে গণ্য হবে।</p>
                </td>
            </tr>
            <tr>
                <th colspan="2">স্বাক্ষর(Signature)</th>
            </tr>
            <tr>
                <td>
                    <label for="">Signature of the Employee
                        with date & Seal(দাবীকারীর স্বাক্ষর ও তারিখ): </label>
                </td>
                <td>
                    <img src="{{ asset('images/'.$claim->signature_employee) }}" alt="" width="200px" height="100px">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Signature of the Coordinator
                        with date & Seal(সমন্বয়কের স্বাক্ষর ও তারিখ): </label>
                </td>
                <td>
                    <img src="{{ asset('images/'.$claim->signature_coordinator) }}" alt="" width="200px" height="100px">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Signature of Authorized Officer
                        with date & Seal(ভারপ্রাপ্তকর্মকর্তারস্বাক্ষর ও তারিখ): </label>
                </td>
                <td>
                    <img src="{{ asset('images/'.$claim->signature_officer) }}" alt="" width="200px" height="100px">
                </td>
            </tr>
            <tr>
                <th colspan="2">সঠিকভাবে পূরনকৃত এই ফর্মের সাথে নিম্নলিখিতকাগজপত্র সংযুক্ত করুন/ Please attach following documents along with duly filled out this claim Form</th>
            </tr>
            <tr>
                <td colspan="2">
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
                </td>
            </tr>


            </tbody>
        </table>

</div>

{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $("#individual1, #individual2, #individual3").hide();--}}
{{--        $("#organization1, #organization2, #organization3").hide();--}}
{{--        $("#insurance_type").on('change', function() {--}}
{{--            let ins_type = $(this).val();--}}
{{--            if (ins_type == "Individual(এককবীমা)") {--}}
{{--                $("#individual1, #individual2, #individual3").show('slow');--}}
{{--                $("#organization1, #organization2, #organization3").hide('slow');--}}
{{--            } else if (ins_type == "Group(গোষ্ঠীবীমা)" || ins_type == "Others(অন্যান্য)") {--}}
{{--                $("#individual1, #individual2, #individual3").hide('slow');--}}
{{--                $("#organization1, #organization2, #organization3").show('slow');--}}
{{--            } else {--}}
{{--                $("#individual1, #individual2, #individual3").hide();--}}
{{--                $("#organization1, #organization2, #organization3").hide();--}}
{{--            }--}}
{{--        })--}}
{{--    });--}}
{{--</script>--}}


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
-->
</body>


</html>
