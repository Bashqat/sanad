@extends('layouts.app')
<title>Add organisation</title>
@section('content')
    <!-- Main content -->
        <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header p-2">
                    <ul class="nav nav-pills justify-content-start px-3">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Add Organization</a></li>
                    </ul>
                    </div><!-- /.card-header --> --}}
                    <div class="card-body">
                    <div class="tab-content org-create-table">
                        <div class="tab-pane active" id="settings">
                        <form class="form-horizontal" method="POST" action="{{ !empty($organisation_data) ? route('org_update') : route('org_store')}}" enctype="multipart/form-data">
                            @csrf
    
                            @if(!empty($organisation_data) )       
                              <input type="hidden" name="org_id" value="{{ isset($organisation_data[0]->org_id) ? $organisation_data[0]->org_id : ''}}"> 
                              <input type="hidden" name="id" value="{{ isset($organisation_data[0]->id) ? $organisation_data[0]->id : ''}}">  
                            @else
                                        
                            @endif
        
                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="display_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Name <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" name="display_name" class="form-control 
                                " id="display_name " placeholder="Enter Organisation Name" required="" value="{{ isset($organisation_data[0]->display_name) ? $organisation_data[0]->display_name : ''}}">
                            </div>
                        </div>
                          <!-- An unexamined life is not worth living. - Socrates -->
       
                            
        
        
                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="legal_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Legal Name <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" name="legal_name" class="form-control 
                                " id="legal_name " placeholder="Enter Legal Name" required="" value="{{ isset($organisation_data[0]->legal_name) ? $organisation_data[0]->legal_name : ''}}">
                            </div>
                        </div>
                            
        
        
                        <!-- An unexamined life is not worth living. - Socrates -->
    
                    <!-- <div class="form-group row">
                        <label for="logo" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Logo </label>
                        <div class="col-lg-9 col-md-9 col-sm-9 input-group">
                            <div class="custom-file">
                                <input type="file" name="logo" class="form-control custom-file-input  " id="logoFile" accept="image/*">
                                <label class="custom-file-label" for="logoFile">Choose file</label>
                            </div>
                        </div>
                    </div> -->
                            
        
        
                        <div class="form-group row">
                            <label for="type_of_organization" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Type of Organization <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9  col-sm-9">
                                <select name="type_of_organization" class="form-control select2  " style="width: 100%;" required="">
                                
                                <option value="">Select </option>
                                    @foreach($organisationType as $key=>$val)
                                      <option value="{{$key}}" {{ (isset($organisation_data[0]->type_of_organization) && $key==$organisation_data[0]->type_of_organization)?'selected':''}}>{{$val}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                    
        
        
                            <div class="form-group row">
                                    <label for="type_of_business" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Type of Business <span style="color:red;">*</span> </label>
                                    <div class="col-lg-9 col-md-9  col-sm-9">
                                        <select name="type_of_business" class="form-control select2  " style="width: 100%;" required="">
                                            <option value="">Select </option>
                                            
                                            @foreach($busType as $buskey=>$busval)
                                                <option value="{{$buskey}}" {{ (isset($organisation_data[0]->type_of_business) && $buskey==$organisation_data[0]->type_of_business)?'selected':''}}>{{$busval}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                            </div>
                    
        
        
                        <!-- An unexamined life is not worth living. - Socrates -->
                            <div class="form-group row">
                                <label for="business_registration_number" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Business Registration Number </label>
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <input type="text" name="business_registration_number" class="form-control 
                                    " id="business_registration_number " placeholder="Enter Business Registration Number" value="{{ isset($organisation_data[0]->business_registration_number) ? $organisation_data[0]->business_registration_number : ''}}">
                                </div>
                            </div>
                            
        
        
                                    <div class="form-group row">
                                        <label for="location" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Location <span style="color:red;">*</span> </label>
                                        <div class="col-lg-9 col-md-9  col-sm-9">
                                            <select name="location" class="form-control select2  " style="width: 100%;" required="">
                                            
                                                    <option value="">Select </option>
                                                    @foreach($countries as $cntkey=>$cntval)
                                                        <option value="{{$cntkey}}" {{ (isset($organisation_data[0]->location) && $cntkey==$organisation_data[0]->location)?'selected':''}}>{{$cntval}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                
        
        
                        <!-- An unexamined life is not worth living. - Socrates -->
                    <div class="form-group row">
                        <label for="address" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Address </label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" name="address" class="form-control 
                            " id="address " placeholder="Enter Address" value="{{ isset($organisation_data[0]->address) ? $organisation_data[0]->address : ''}}">
                        </div>
                    </div>
                            
        
        
                        <!-- <div class="form-group row">
                        <label for="current_date_utc_format" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Current Date UTC Format <span style="color:red;">*</span> </label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                                    <select name="current_date_utc_format" class="form-control select2 " style="width: 100%;" required="">
                                            <option value="">Select Current Date UTC Format</option>
                                            <optgroup label="General">
                                            <option value="GMT">GMT timezone</option>
                                            <option value="UTC">UTC timezone</option>
                                            </optgroup><optgroup label="Africa">
                                            <option value="Africa/Abidjan">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Abidjan</option>
                                            <option value="Africa/Accra">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Accra</option>
                                            <option value="Africa/Addis_Ababa">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Addis Ababa</option>
                                            <option value="Africa/Algiers">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Algiers</option>
                                            <option value="Africa/Asmara">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Asmara</option>
                                            <option value="Africa/Bamako">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Bamako</option>
                                            <option value="Africa/Bangui">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Bangui</option>
                                            <option value="Africa/Banjul">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Banjul</option>
                                            <option value="Africa/Bissau">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Bissau</option>
                                            <option value="Africa/Blantyre">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Blantyre</option>
                                            <option value="Africa/Brazzaville">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Brazzaville</option>
                                            <option value="Africa/Bujumbura">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Bujumbura</option>
                                            <option value="Africa/Cairo">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Cairo</option>
                                            <option value="Africa/Casablanca">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Casablanca</option>
                                            <option value="Africa/Ceuta">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Ceuta</option>
                                            <option value="Africa/Conakry">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Conakry</option>
                                            <option value="Africa/Dakar">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Dakar</option>
                                            <option value="Africa/Dar_es_Salaam">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Dar es Salaam</option>
                                            <option value="Africa/Djibouti">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Djibouti</option>
                                            <option value="Africa/Douala">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Douala</option>
                                            <option value="Africa/El_Aaiun">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;El Aaiun</option>
                                            <option value="Africa/Freetown">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Freetown</option>
                                            <option value="Africa/Gaborone">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Gaborone</option>
                                            <option value="Africa/Harare">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Harare</option>
                                            <option value="Africa/Johannesburg">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Johannesburg</option>
                                            <option value="Africa/Juba">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Juba</option>
                                            <option value="Africa/Kampala">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Kampala</option>
                                            <option value="Africa/Khartoum">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Khartoum</option>
                                            <option value="Africa/Kigali">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Kigali</option>
                                            <option value="Africa/Kinshasa">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Kinshasa</option>
                                            <option value="Africa/Lagos">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Lagos</option>
                                            <option value="Africa/Libreville">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Libreville</option>
                                            <option value="Africa/Lome">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Lome</option>
                                            <option value="Africa/Luanda">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Luanda</option>
                                            <option value="Africa/Lubumbashi">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Lubumbashi</option>
                                            <option value="Africa/Lusaka">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Lusaka</option>
                                            <option value="Africa/Malabo">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Malabo</option>
                                            <option value="Africa/Maputo">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Maputo</option>
                                            <option value="Africa/Maseru">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Maseru</option>
                                            <option value="Africa/Mbabane">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Mbabane</option>
                                            <option value="Africa/Mogadishu">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Mogadishu</option>
                                            <option value="Africa/Monrovia">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Monrovia</option>
                                            <option value="Africa/Nairobi">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Nairobi</option>
                                            <option value="Africa/Ndjamena">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Ndjamena</option>
                                            <option value="Africa/Niamey">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Niamey</option>
                                            <option value="Africa/Nouakchott">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Nouakchott</option>
                                            <option value="Africa/Ouagadougou">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Ouagadougou</option>
                                            <option value="Africa/Porto-Novo">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Porto-Novo</option>
                                            <option value="Africa/Sao_Tome">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Sao Tome</option>
                                            <option value="Africa/Tripoli">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Tripoli</option>
                                            <option value="Africa/Tunis">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Tunis</option>
                                            <option value="Africa/Windhoek">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Windhoek</option>
                                            </optgroup><optgroup label="America">
                                            <option value="America/Adak">(GMT/UTC − 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Adak</option>
                                            <option value="America/Anchorage">(GMT/UTC − 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Anchorage</option>
                                            <option value="America/Anguilla">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Anguilla</option>
                                            <option value="America/Antigua">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Antigua</option>
                                            <option value="America/Araguaina">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Araguaina</option>
                                            <option value="America/Argentina/Buenos_Aires">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/Buenos Aires</option>
                                            <option value="America/Argentina/Catamarca">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/Catamarca</option>
                                            <option value="America/Argentina/Cordoba">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/Cordoba</option>
                                            <option value="America/Argentina/Jujuy">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/Jujuy</option>
                                            <option value="America/Argentina/La_Rioja">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/La Rioja</option>
                                            <option value="America/Argentina/Mendoza">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/Mendoza</option>
                                            <option value="America/Argentina/Rio_Gallegos">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/Rio Gallegos</option>
                                            <option value="America/Argentina/Salta">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/Salta</option>
                                            <option value="America/Argentina/San_Juan">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/San Juan</option>
                                            <option value="America/Argentina/San_Luis">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/San Luis</option>
                                            <option value="America/Argentina/Tucuman">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/Tucuman</option>
                                            <option value="America/Argentina/Ushuaia">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Argentina/Ushuaia</option>
                                            <option value="America/Aruba">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Aruba</option>
                                            <option value="America/Asuncion">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Asuncion</option>
                                            <option value="America/Atikokan">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Atikokan</option>
                                            <option value="America/Bahia">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Bahia</option>
                                            <option value="America/Bahia_Banderas">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Bahia Banderas</option>
                                            <option value="America/Barbados">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Barbados</option>
                                            <option value="America/Belem">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Belem</option>
                                            <option value="America/Belize">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Belize</option>
                                            <option value="America/Blanc-Sablon">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Blanc-Sablon</option>
                                            <option value="America/Boa_Vista">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Boa Vista</option>
                                            <option value="America/Bogota">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Bogota</option>
                                            <option value="America/Boise">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Boise</option>
                                            <option value="America/Cambridge_Bay">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Cambridge Bay</option>
                                            <option value="America/Campo_Grande">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Campo Grande</option>
                                            <option value="America/Cancun">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Cancun</option>
                                            <option value="America/Caracas">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Caracas</option>
                                            <option value="America/Cayenne">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Cayenne</option>
                                            <option value="America/Cayman">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Cayman</option>
                                            <option value="America/Chicago">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Chicago</option>
                                            <option value="America/Chihuahua">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Chihuahua</option>
                                            <option value="America/Costa_Rica">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Costa Rica</option>
                                            <option value="America/Creston">(GMT/UTC − 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Creston</option>
                                            <option value="America/Cuiaba">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Cuiaba</option>
                                            <option value="America/Curacao">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Curacao</option>
                                            <option value="America/Danmarkshavn">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Danmarkshavn</option>
                                            <option value="America/Dawson">(GMT/UTC − 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Dawson</option>
                                            <option value="America/Dawson_Creek">(GMT/UTC − 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Dawson Creek</option>
                                            <option value="America/Denver">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Denver</option>
                                            <option value="America/Detroit">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Detroit</option>
                                            <option value="America/Dominica">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Dominica</option>
                                            <option value="America/Edmonton">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Edmonton</option>
                                            <option value="America/Eirunepe">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Eirunepe</option>
                                            <option value="America/El_Salvador">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;El Salvador</option>
                                            <option value="America/Fort_Nelson">(GMT/UTC − 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Fort Nelson</option>
                                            <option value="America/Fortaleza">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Fortaleza</option>
                                            <option value="America/Glace_Bay">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Glace Bay</option>
                                            <option value="America/Goose_Bay">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Goose Bay</option>
                                            <option value="America/Grand_Turk">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Grand Turk</option>
                                            <option value="America/Grenada">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Grenada</option>
                                            <option value="America/Guadeloupe">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Guadeloupe</option>
                                            <option value="America/Guatemala">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Guatemala</option>
                                            <option value="America/Guayaquil">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Guayaquil</option>
                                            <option value="America/Guyana">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Guyana</option>
                                            <option value="America/Halifax">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Halifax</option>
                                            <option value="America/Havana">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Havana</option>
                                            <option value="America/Hermosillo">(GMT/UTC − 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Hermosillo</option>
                                            <option value="America/Indiana/Indianapolis">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Indiana/Indianapolis</option>
                                            <option value="America/Indiana/Knox">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Indiana/Knox</option>
                                            <option value="America/Indiana/Marengo">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Indiana/Marengo</option>
                                            <option value="America/Indiana/Petersburg">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Indiana/Petersburg</option>
                                            <option value="America/Indiana/Tell_City">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Indiana/Tell City</option>
                                            <option value="America/Indiana/Vevay">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Indiana/Vevay</option>
                                            <option value="America/Indiana/Vincennes">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Indiana/Vincennes</option>
                                            <option value="America/Indiana/Winamac">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Indiana/Winamac</option>
                                            <option value="America/Inuvik">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Inuvik</option>
                                            <option value="America/Iqaluit">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Iqaluit</option>
                                            <option value="America/Jamaica">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Jamaica</option>
                                            <option value="America/Juneau">(GMT/UTC − 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Juneau</option>
                                            <option value="America/Kentucky/Louisville">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Kentucky/Louisville</option>
                                            <option value="America/Kentucky/Monticello">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Kentucky/Monticello</option>
                                            <option value="America/Kralendijk">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Kralendijk</option>
                                            <option value="America/La_Paz">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;La Paz</option>
                                            <option value="America/Lima">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Lima</option>
                                            <option value="America/Los_Angeles">(GMT/UTC − 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Los Angeles</option>
                                            <option value="America/Lower_Princes">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Lower Princes</option>
                                            <option value="America/Maceio">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Maceio</option>
                                            <option value="America/Managua">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Managua</option>
                                            <option value="America/Manaus">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Manaus</option>
                                            <option value="America/Marigot">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Marigot</option>
                                            <option value="America/Martinique">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Martinique</option>
                                            <option value="America/Matamoros">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Matamoros</option>
                                            <option value="America/Mazatlan">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Mazatlan</option>
                                            <option value="America/Menominee">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Menominee</option>
                                            <option value="America/Merida">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Merida</option>
                                            <option value="America/Metlakatla">(GMT/UTC − 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Metlakatla</option>
                                            <option value="America/Mexico_City">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Mexico City</option>
                                            <option value="America/Miquelon">(GMT/UTC − 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Miquelon</option>
                                            <option value="America/Moncton">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Moncton</option>
                                            <option value="America/Monterrey">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Monterrey</option>
                                            <option value="America/Montevideo">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Montevideo</option>
                                            <option value="America/Montserrat">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Montserrat</option>
                                            <option value="America/Nassau">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Nassau</option>
                                            <option value="America/New_York">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;New York</option>
                                            <option value="America/Nipigon">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Nipigon</option>
                                            <option value="America/Nome">(GMT/UTC − 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Nome</option>
                                            <option value="America/Noronha">(GMT/UTC − 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Noronha</option>
                                            <option value="America/North_Dakota/Beulah">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;North Dakota/Beulah</option>
                                            <option value="America/North_Dakota/Center">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;North Dakota/Center</option>
                                            <option value="America/North_Dakota/New_Salem">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;North Dakota/New Salem</option>
                                            <option value="America/Nuuk">(GMT/UTC − 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Nuuk</option>
                                            <option value="America/Ojinaga">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Ojinaga</option>
                                            <option value="America/Panama">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Panama</option>
                                            <option value="America/Pangnirtung">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Pangnirtung</option>
                                            <option value="America/Paramaribo">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Paramaribo</option>
                                            <option value="America/Phoenix">(GMT/UTC − 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Phoenix</option>
                                            <option value="America/Port-au-Prince">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Port-au-Prince</option>
                                            <option value="America/Port_of_Spain">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Port of Spain</option>
                                            <option value="America/Porto_Velho">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Porto Velho</option>
                                            <option value="America/Puerto_Rico">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Puerto Rico</option>
                                            <option value="America/Punta_Arenas">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Punta Arenas</option>
                                            <option value="America/Rainy_River">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Rainy River</option>
                                            <option value="America/Rankin_Inlet">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Rankin Inlet</option>
                                            <option value="America/Recife">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Recife</option>
                                            <option value="America/Regina">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Regina</option>
                                            <option value="America/Resolute">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Resolute</option>
                                            <option value="America/Rio_Branco">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Rio Branco</option>
                                            <option value="America/Santarem">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Santarem</option>
                                            <option value="America/Santiago">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Santiago</option>
                                            <option value="America/Santo_Domingo">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Santo Domingo</option>
                                            <option value="America/Sao_Paulo">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Sao Paulo</option>
                                            <option value="America/Scoresbysund">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Scoresbysund</option>
                                            <option value="America/Sitka">(GMT/UTC − 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Sitka</option>
                                            <option value="America/St_Barthelemy">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;St. Barthelemy</option>
                                            <option value="America/St_Johns">(GMT/UTC − 02:30)&nbsp;&nbsp;&nbsp;&nbsp;St. Johns</option>
                                            <option value="America/St_Kitts">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;St. Kitts</option>
                                            <option value="America/St_Lucia">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;St. Lucia</option>
                                            <option value="America/St_Thomas">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;St. Thomas</option>
                                            <option value="America/St_Vincent">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;St. Vincent</option>
                                            <option value="America/Swift_Current">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Swift Current</option>
                                            <option value="America/Tegucigalpa">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Tegucigalpa</option>
                                            <option value="America/Thule">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Thule</option>
                                            <option value="America/Thunder_Bay">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Thunder Bay</option>
                                            <option value="America/Tijuana">(GMT/UTC − 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Tijuana</option>
                                            <option value="America/Toronto">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Toronto</option>
                                            <option value="America/Tortola">(GMT/UTC − 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Tortola</option>
                                            <option value="America/Vancouver">(GMT/UTC − 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Vancouver</option>
                                            <option value="America/Whitehorse">(GMT/UTC − 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Whitehorse</option>
                                            <option value="America/Winnipeg">(GMT/UTC − 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Winnipeg</option>
                                            <option value="America/Yakutat">(GMT/UTC − 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Yakutat</option>
                                            <option value="America/Yellowknife">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Yellowknife</option>
                                            </optgroup><optgroup label="Antarctica">
                                            <option value="Antarctica/Casey">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Casey</option>
                                            <option value="Antarctica/Davis">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Davis</option>
                                            <option value="Antarctica/DumontDUrville">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;DumontDUrville</option>
                                            <option value="Antarctica/Macquarie">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Macquarie</option>
                                            <option value="Antarctica/Mawson">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Mawson</option>
                                            <option value="Antarctica/McMurdo">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;McMurdo</option>
                                            <option value="Antarctica/Palmer">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Palmer</option>
                                            <option value="Antarctica/Rothera">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Rothera</option>
                                            <option value="Antarctica/Syowa">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Syowa</option>
                                            <option value="Antarctica/Troll">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Troll</option>
                                            <option value="Antarctica/Vostok">(GMT/UTC + 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Vostok</option>
                                            </optgroup><optgroup label="Arctic">
                                            <option value="Arctic/Longyearbyen">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Longyearbyen</option>
                                            </optgroup><optgroup label="Asia">
                                            <option value="Asia/Aden">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Aden</option>
                                            <option value="Asia/Almaty">(GMT/UTC + 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Almaty</option>
                                            <option value="Asia/Amman">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Amman</option>
                                            <option value="Asia/Anadyr">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Anadyr</option>
                                            <option value="Asia/Aqtau">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Aqtau</option>
                                            <option value="Asia/Aqtobe">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Aqtobe</option>
                                            <option value="Asia/Ashgabat">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Ashgabat</option>
                                            <option value="Asia/Atyrau">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Atyrau</option>
                                            <option value="Asia/Baghdad">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Baghdad</option>
                                            <option value="Asia/Bahrain">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Bahrain</option>
                                            <option value="Asia/Baku">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Baku</option>
                                            <option value="Asia/Bangkok">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Bangkok</option>
                                            <option value="Asia/Barnaul">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Barnaul</option>
                                            <option value="Asia/Beirut">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Beirut</option>
                                            <option value="Asia/Bishkek">(GMT/UTC + 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Bishkek</option>
                                            <option value="Asia/Brunei">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Brunei</option>
                                            <option value="Asia/Chita">(GMT/UTC + 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Chita</option>
                                            <option value="Asia/Choibalsan">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Choibalsan</option>
                                            <option value="Asia/Colombo">(GMT/UTC + 05:30)&nbsp;&nbsp;&nbsp;&nbsp;Colombo</option>
                                            <option value="Asia/Damascus">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Damascus</option>
                                            <option value="Asia/Dhaka">(GMT/UTC + 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Dhaka</option>
                                            <option value="Asia/Dili">(GMT/UTC + 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Dili</option>
                                            <option value="Asia/Dubai">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Dubai</option>
                                            <option value="Asia/Dushanbe">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Dushanbe</option>
                                            <option value="Asia/Famagusta">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Famagusta</option>
                                            <option value="Asia/Gaza">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Gaza</option>
                                            <option value="Asia/Hebron">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Hebron</option>
                                            <option value="Asia/Ho_Chi_Minh">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Ho Chi Minh</option>
                                            <option value="Asia/Hong_Kong">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Hong Kong</option>
                                            <option value="Asia/Hovd">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Hovd</option>
                                            <option value="Asia/Irkutsk">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Irkutsk</option>
                                            <option value="Asia/Jakarta">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Jakarta</option>
                                            <option value="Asia/Jayapura">(GMT/UTC + 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Jayapura</option>
                                            <option value="Asia/Jerusalem">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Jerusalem</option>
                                            <option value="Asia/Kabul">(GMT/UTC + 04:30)&nbsp;&nbsp;&nbsp;&nbsp;Kabul</option>
                                            <option value="Asia/Kamchatka">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Kamchatka</option>
                                            <option value="Asia/Karachi">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Karachi</option>
                                            <option value="Asia/Kathmandu">(GMT/UTC + 05:45)&nbsp;&nbsp;&nbsp;&nbsp;Kathmandu</option>
                                            <option value="Asia/Khandyga">(GMT/UTC + 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Khandyga</option>
                                            <option value="Asia/Kolkata">(GMT/UTC + 05:30)&nbsp;&nbsp;&nbsp;&nbsp;Kolkata</option>
                                            <option value="Asia/Krasnoyarsk">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Krasnoyarsk</option>
                                            <option value="Asia/Kuala_Lumpur">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Kuala Lumpur</option>
                                            <option value="Asia/Kuching">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Kuching</option>
                                            <option value="Asia/Kuwait">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Kuwait</option>
                                            <option value="Asia/Macau">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Macau</option>
                                            <option value="Asia/Magadan">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Magadan</option>
                                            <option value="Asia/Makassar">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Makassar</option>
                                            <option value="Asia/Manila">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Manila</option>
                                            <option value="Asia/Muscat">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Muscat</option>
                                            <option value="Asia/Nicosia">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Nicosia</option>
                                            <option value="Asia/Novokuznetsk">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Novokuznetsk</option>
                                            <option value="Asia/Novosibirsk">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Novosibirsk</option>
                                            <option value="Asia/Omsk">(GMT/UTC + 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Omsk</option>
                                            <option value="Asia/Oral">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Oral</option>
                                            <option value="Asia/Phnom_Penh">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Phnom Penh</option>
                                            <option value="Asia/Pontianak">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Pontianak</option>
                                            <option value="Asia/Pyongyang">(GMT/UTC + 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Pyongyang</option>
                                            <option value="Asia/Qatar">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Qatar</option>
                                            <option value="Asia/Qostanay">(GMT/UTC + 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Qostanay</option>
                                            <option value="Asia/Qyzylorda">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Qyzylorda</option>
                                            <option value="Asia/Riyadh">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Riyadh</option>
                                            <option value="Asia/Sakhalin">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Sakhalin</option>
                                            <option value="Asia/Samarkand">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Samarkand</option>
                                            <option value="Asia/Seoul">(GMT/UTC + 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Seoul</option>
                                            <option value="Asia/Shanghai">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Shanghai</option>
                                            <option value="Asia/Singapore">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Singapore</option>
                                            <option value="Asia/Srednekolymsk">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Srednekolymsk</option>
                                            <option value="Asia/Taipei">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Taipei</option>
                                            <option value="Asia/Tashkent">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Tashkent</option>
                                            <option value="Asia/Tbilisi">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Tbilisi</option>
                                            <option value="Asia/Tehran">(GMT/UTC + 04:30)&nbsp;&nbsp;&nbsp;&nbsp;Tehran</option>
                                            <option value="Asia/Thimphu">(GMT/UTC + 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Thimphu</option>
                                            <option value="Asia/Tokyo">(GMT/UTC + 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Tokyo</option>
                                            <option value="Asia/Tomsk">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Tomsk</option>
                                            <option value="Asia/Ulaanbaatar">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Ulaanbaatar</option>
                                            <option value="Asia/Urumqi">(GMT/UTC + 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Urumqi</option>
                                            <option value="Asia/Ust-Nera">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Ust-Nera</option>
                                            <option value="Asia/Vientiane">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Vientiane</option>
                                            <option value="Asia/Vladivostok">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Vladivostok</option>
                                            <option value="Asia/Yakutsk">(GMT/UTC + 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Yakutsk</option>
                                            <option value="Asia/Yangon">(GMT/UTC + 06:30)&nbsp;&nbsp;&nbsp;&nbsp;Yangon</option>
                                            <option value="Asia/Yekaterinburg">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Yekaterinburg</option>
                                            <option value="Asia/Yerevan">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Yerevan</option>
                                                </optgroup><optgroup label="Atlantic">
                                            <option value="Atlantic/Azores">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Azores</option>
                                            <option value="Atlantic/Bermuda">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Bermuda</option>
                                            <option value="Atlantic/Canary">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Canary</option>
                                            <option value="Atlantic/Cape_Verde">(GMT/UTC − 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Cape Verde</option>
                                            <option value="Atlantic/Faroe">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Faroe</option>
                                            <option value="Atlantic/Madeira">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Madeira</option>
                                            <option value="Atlantic/Reykjavik">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;Reykjavik</option>
                                            <option value="Atlantic/South_Georgia">(GMT/UTC − 02:00)&nbsp;&nbsp;&nbsp;&nbsp;South Georgia</option>
                                            <option value="Atlantic/St_Helena">(GMT/UTC + 00:00)&nbsp;&nbsp;&nbsp;&nbsp;St. Helena</option>
                                            <option value="Atlantic/Stanley">(GMT/UTC − 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Stanley</option>
                                                </optgroup><optgroup label="Australia">
                                            <option value="Australia/Adelaide">(GMT/UTC + 09:30)&nbsp;&nbsp;&nbsp;&nbsp;Adelaide</option>
                                            <option value="Australia/Brisbane">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Brisbane</option>
                                            <option value="Australia/Broken_Hill">(GMT/UTC + 09:30)&nbsp;&nbsp;&nbsp;&nbsp;Broken Hill</option>
                                            <option value="Australia/Darwin">(GMT/UTC + 09:30)&nbsp;&nbsp;&nbsp;&nbsp;Darwin</option>
                                            <option value="Australia/Eucla">(GMT/UTC + 08:45)&nbsp;&nbsp;&nbsp;&nbsp;Eucla</option>
                                            <option value="Australia/Hobart">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Hobart</option>
                                            <option value="Australia/Lindeman">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Lindeman</option>
                                            <option value="Australia/Lord_Howe">(GMT/UTC + 10:30)&nbsp;&nbsp;&nbsp;&nbsp;Lord Howe</option>
                                            <option value="Australia/Melbourne">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Melbourne</option>
                                            <option value="Australia/Perth">(GMT/UTC + 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Perth</option>
                                            <option value="Australia/Sydney">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Sydney</option>
                                                </optgroup><optgroup label="Europe">
                                            <option value="Europe/Amsterdam">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Amsterdam</option>
                                            <option value="Europe/Andorra">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Andorra</option>
                                            <option value="Europe/Astrakhan">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Astrakhan</option>
                                            <option value="Europe/Athens">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Athens</option>
                                            <option value="Europe/Belgrade">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Belgrade</option>
                                            <option value="Europe/Berlin">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Berlin</option>
                                            <option value="Europe/Bratislava">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Bratislava</option>
                                            <option value="Europe/Brussels">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Brussels</option>
                                            <option value="Europe/Bucharest">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Bucharest</option>
                                            <option value="Europe/Budapest">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Budapest</option>
                                            <option value="Europe/Busingen">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Busingen</option>
                                            <option value="Europe/Chisinau">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Chisinau</option>
                                            <option value="Europe/Copenhagen">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Copenhagen</option>
                                            <option value="Europe/Dublin">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Dublin</option>
                                            <option value="Europe/Gibraltar">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Gibraltar</option>
                                            <option value="Europe/Guernsey">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Guernsey</option>
                                            <option value="Europe/Helsinki">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Helsinki</option>
                                            <option value="Europe/Isle_of_Man">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Isle of Man</option>
                                            <option value="Europe/Istanbul">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Istanbul</option>
                                            <option value="Europe/Jersey">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Jersey</option>
                                            <option value="Europe/Kaliningrad">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Kaliningrad</option>
                                            <option value="Europe/Kiev">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Kiev</option>
                                            <option value="Europe/Kirov">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Kirov</option>
                                            <option value="Europe/Lisbon">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;Lisbon</option>
                                            <option value="Europe/Ljubljana">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Ljubljana</option>
                                            <option value="Europe/London">(GMT/UTC + 01:00)&nbsp;&nbsp;&nbsp;&nbsp;London</option>
                                            <option value="Europe/Luxembourg">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Luxembourg</option>
                                            <option value="Europe/Madrid">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Madrid</option>
                                            <option value="Europe/Malta">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Malta</option>
                                            <option value="Europe/Mariehamn">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Mariehamn</option>
                                            <option value="Europe/Minsk">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Minsk</option>
                                            <option value="Europe/Monaco">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Monaco</option>
                                            <option value="Europe/Moscow">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Moscow</option>
                                            <option value="Europe/Oslo">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Oslo</option>
                                            <option value="Europe/Paris">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Paris</option>
                                            <option value="Europe/Podgorica">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Podgorica</option>
                                            <option value="Europe/Prague">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Prague</option>
                                            <option value="Europe/Riga">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Riga</option>
                                            <option value="Europe/Rome">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Rome</option>
                                            <option value="Europe/Samara">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Samara</option>
                                            <option value="Europe/San_Marino">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;San Marino</option>
                                            <option value="Europe/Sarajevo">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Sarajevo</option>
                                            <option value="Europe/Saratov">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Saratov</option>
                                            <option value="Europe/Simferopol">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Simferopol</option>
                                            <option value="Europe/Skopje">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Skopje</option>
                                            <option value="Europe/Sofia">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Sofia</option>
                                            <option value="Europe/Stockholm">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Stockholm</option>
                                            <option value="Europe/Tallinn">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Tallinn</option>
                                            <option value="Europe/Tirane">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Tirane</option>
                                            <option value="Europe/Ulyanovsk">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Ulyanovsk</option>
                                            <option value="Europe/Uzhgorod">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Uzhgorod</option>
                                            <option value="Europe/Vaduz">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Vaduz</option>
                                            <option value="Europe/Vatican">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Vatican</option>
                                            <option value="Europe/Vienna">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Vienna</option>
                                            <option value="Europe/Vilnius">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Vilnius</option>
                                            <option value="Europe/Volgograd">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Volgograd</option>
                                            <option value="Europe/Warsaw">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Warsaw</option>
                                            <option value="Europe/Zagreb">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Zagreb</option>
                                            <option value="Europe/Zaporozhye">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Zaporozhye</option>
                                            <option value="Europe/Zurich">(GMT/UTC + 02:00)&nbsp;&nbsp;&nbsp;&nbsp;Zurich</option>
                                                </optgroup><optgroup label="Indian">
                                            <option value="Indian/Antananarivo">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Antananarivo</option>
                                            <option value="Indian/Chagos">(GMT/UTC + 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Chagos</option>
                                            <option value="Indian/Christmas">(GMT/UTC + 07:00)&nbsp;&nbsp;&nbsp;&nbsp;Christmas</option>
                                            <option value="Indian/Cocos">(GMT/UTC + 06:30)&nbsp;&nbsp;&nbsp;&nbsp;Cocos</option>
                                            <option value="Indian/Comoro">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Comoro</option>
                                            <option value="Indian/Kerguelen">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Kerguelen</option>
                                            <option value="Indian/Mahe">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Mahe</option>
                                            <option value="Indian/Maldives">(GMT/UTC + 05:00)&nbsp;&nbsp;&nbsp;&nbsp;Maldives</option>
                                            <option value="Indian/Mauritius">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Mauritius</option>
                                            <option value="Indian/Mayotte">(GMT/UTC + 03:00)&nbsp;&nbsp;&nbsp;&nbsp;Mayotte</option>
                                            <option value="Indian/Reunion">(GMT/UTC + 04:00)&nbsp;&nbsp;&nbsp;&nbsp;Reunion</option>
                                                </optgroup><optgroup label="Pacific">
                                            <option value="Pacific/Apia">(GMT/UTC + 13:00)&nbsp;&nbsp;&nbsp;&nbsp;Apia</option>
                                            <option value="Pacific/Auckland">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Auckland</option>
                                            <option value="Pacific/Bougainville">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Bougainville</option>
                                            <option value="Pacific/Chatham">(GMT/UTC + 12:45)&nbsp;&nbsp;&nbsp;&nbsp;Chatham</option>
                                            <option value="Pacific/Chuuk">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Chuuk</option>
                                            <option value="Pacific/Easter">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Easter</option>
                                            <option value="Pacific/Efate">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Efate</option>
                                            <option value="Pacific/Enderbury">(GMT/UTC + 13:00)&nbsp;&nbsp;&nbsp;&nbsp;Enderbury</option>
                                            <option value="Pacific/Fakaofo">(GMT/UTC + 13:00)&nbsp;&nbsp;&nbsp;&nbsp;Fakaofo</option>
                                            <option value="Pacific/Fiji">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Fiji</option>
                                            <option value="Pacific/Funafuti">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Funafuti</option>
                                            <option value="Pacific/Galapagos">(GMT/UTC − 06:00)&nbsp;&nbsp;&nbsp;&nbsp;Galapagos</option>
                                            <option value="Pacific/Gambier">(GMT/UTC − 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Gambier</option>
                                            <option value="Pacific/Guadalcanal">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Guadalcanal</option>
                                            <option value="Pacific/Guam">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Guam</option>
                                            <option value="Pacific/Honolulu">(GMT/UTC − 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Honolulu</option>
                                            <option value="Pacific/Kiritimati">(GMT/UTC + 14:00)&nbsp;&nbsp;&nbsp;&nbsp;Kiritimati</option>
                                            <option value="Pacific/Kosrae">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Kosrae</option>
                                            <option value="Pacific/Kwajalein">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Kwajalein</option>
                                            <option value="Pacific/Majuro">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Majuro</option>
                                            <option value="Pacific/Marquesas">(GMT/UTC − 09:30)&nbsp;&nbsp;&nbsp;&nbsp;Marquesas</option>
                                            <option value="Pacific/Midway">(GMT/UTC − 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Midway</option>
                                            <option value="Pacific/Nauru">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Nauru</option>
                                            <option value="Pacific/Niue">(GMT/UTC − 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Niue</option>
                                            <option value="Pacific/Norfolk">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Norfolk</option>
                                            <option value="Pacific/Noumea">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Noumea</option>
                                            <option value="Pacific/Pago_Pago">(GMT/UTC − 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Pago Pago</option>
                                            <option value="Pacific/Palau">(GMT/UTC + 09:00)&nbsp;&nbsp;&nbsp;&nbsp;Palau</option>
                                            <option value="Pacific/Pitcairn">(GMT/UTC − 08:00)&nbsp;&nbsp;&nbsp;&nbsp;Pitcairn</option>
                                            <option value="Pacific/Pohnpei">(GMT/UTC + 11:00)&nbsp;&nbsp;&nbsp;&nbsp;Pohnpei</option>
                                            <option value="Pacific/Port_Moresby">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Port Moresby</option>
                                            <option value="Pacific/Rarotonga">(GMT/UTC − 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Rarotonga</option>
                                            <option value="Pacific/Saipan">(GMT/UTC + 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Saipan</option>
                                            <option value="Pacific/Tahiti">(GMT/UTC − 10:00)&nbsp;&nbsp;&nbsp;&nbsp;Tahiti</option>
                                            <option value="Pacific/Tarawa">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Tarawa</option>
                                            <option value="Pacific/Tongatapu">(GMT/UTC + 13:00)&nbsp;&nbsp;&nbsp;&nbsp;Tongatapu</option>
                                            <option value="Pacific/Wake">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Wake</option>
                                            <option value="Pacific/Wallis">(GMT/UTC + 12:00)&nbsp;&nbsp;&nbsp;&nbsp;Wallis</option>
                                        </optgroup>
                                    </select>
                            </div>
                        </div> -->

                    
        
        
                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="phone" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Phone </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="phone" class="form-control 
                        " id="phone " placeholder="Enter Phone" value="{{ isset($organisation_data[0]->phone) ? $organisation_data[0]->phone : ''}}">
                    </div>
                </div>
                            
        
        
                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="fax" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Fax </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="fax" class="form-control 
                        " id="fax " placeholder="Enter Fax" value="{{ isset($organisation_data[0]->fax) ? $organisation_data[0]->fax : ''}}">
                    </div>
                </div>
                            
        
        
                        <!-- An unexamined life is not worth living. - Socrates -->
            <div class="form-group row">
                <label for="mobile" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Mobile </label>
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <input type="text" name="mobile" class="form-control 
                    " id="mobile " placeholder="Enter Mobile" value="{{ isset($organisation_data[0]->mobile) ? $organisation_data[0]->mobile : ''}}">
                </div>
            </div>
                            
        
        
                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="website" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Website </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="website" class="form-control 
                        " id="website " placeholder="Enter Website" value="{{ isset($organisation_data[0]->website) ? $organisation_data[0]->website : ''}}">
                    </div>
                </div>
                            
        
        
                        <!-- An unexamined life is not worth living. - Socrates -->
            <div class="form-group row">
                <label for="email" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Email </label>
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <input type="text" name="email" class="form-control 
                    " id="email " placeholder="Enter Email" value="{{ isset($organisation_data[0]->email) ? $organisation_data[0]->email : ''}}">
                </div>
            </div>
                            
        
        
                        <div class="form-group row">
                            <label for="currency" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Currency <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9  col-sm-9">
                                <select name="currency" class="form-control select2  " style="width: 100%;" required="">
                                    <option value="">Select </option>
                                    <option value="0" selected="">USD</option>
                                    <option value="1">EUR</option>
                                    <option value="2">JPY</option>
                                    <option value="3">GBP</option>
                                    <option value="4">CHF</option>
                                    <option value="5">CAD</option>
                                    <option value="6">AUD</option>
                                    <option value="7">ZAR</option>
                                </select>
                            </div>
                        </div>
                    
        
        
                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="user_defined" class="col-lg-3 col-md-3 col-sm-3 col-form-label">User Defined </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="user_defined" class="form-control 
                        " id="user_defined " placeholder="Enter User Defined" value="{{ isset($organisation_data[0]->user_defined) ? $organisation_data[0]->user_defined : ''}}">
                    </div>
                </div>
                            
        
                            
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10 text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    
                                </div>
                            </div>
                        </form>
                </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection
