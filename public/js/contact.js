$(document).ready(function(){

  var org_id=$('.org_id').val();
  var table=$('#contact_table').DataTable({
   //"scrollX": true,
   //"pagingType": "numbers",
       "processing": true,
       "serverSide": true,
       "ajax": '/organisation/'+org_id+'/contact/server-side',

   } );
   $('#contacts_archive_table').DataTable({
    //"scrollX": true,
    //"pagingType": "numbers",
          "processing": true,
            "serverSide": true,
            "searching": true,
            "ajax": '/organisation/'+org_id+'/contact/archive/server-side',


    } );
   $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
    $(document).on('click', '.filter', function () {
      var filter_value=[];
      $('.filter').each(function(){
        if($(this).prop("checked") == true)
         {
           filter_value.push($(this).val());
         }
       })
         $('#contact_table').DataTable({
          //"scrollX": true,
          //"pagingType": "numbers",
                data: {
                  "filter_value": filter_value,

                },
                  "processing": true,
                  "serverSide": true,
                  "searching": true,
                  "ajax": '/organisation/'+org_id+'/contact/server-side',


          } );

    })

    var siteurl = window.location.origin;

	$(document).on('click', '.mobile-clone', function () {
		var count = parseInt($(this).attr('data-count')) + 1;
		$(this).attr('data-count', count);
		var formCount = $('#add_person').attr('data-count');
		var field = `
        <div class="form-group row contact-row" id="mobile-field${count}">
            <label for="mobile" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Mobile ( ${count+1} )
                <a href="javascript:void(0)" class="removeEle" data-id="mobile-field${count}" data-btn="add_mobile">Remove</a>
            </label>
            <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">
                <select name="persons_contacts[${formCount}][mobile][${count}][type]" class="form-control select2 select-input-field color-change col-md-3 " style="width: 100%;">
                    <option value="">Select Type</option>
                    <option value="main">Main</option>
                    <option value="work">Work</option>
                    <option value="whatsapp">Whatsapp</option>
                </select>
                <input type="text" name="persons_contacts[${formCount}][mobile][${count}][area]" class="form-control col-md-3" placeholder="Area">
                <input type="tel" name="persons_contacts[${formCount}][mobile][${count}][number]" class="form-control col-md-3" placeholder="Number">
                <input type="tel" name="persons_contacts[${formCount}][mobile][${count}][extention]" class="form-control col-md-3" placeholder="Extention">
            </div>
        </div>
        `;
		$(field).insertBefore(this);
	});

	$(document).on('click', '#add_person', function () {
		var count = parseInt($(this).attr('data-count')) + 1;
		$(this).attr('data-count', count);
		var form = `
        <div id="persons_contacts${count}">
            <h4 class="modal-title mt-2 mb-2">Person Contact ( ${count+1} )
                <a href="javascript:void(0)" class="removeEle" data-id="persons_contacts${count}" data-btn="add_person">Remove</a>
            </h4>
            <div class="form-group row">
                <label for="name" class="col-lg-3 col-md-3 col-sm-4 col-form-label p-0"> </label>
                <div class="col-lg-9 col-md-9 col-sm-8">
					<div class="person-contact">
                    <input type="text" name="persons_contacts[${count}][first_name]" class="form-control col-md-6" placeholder="First Name">
                    <input type="text" name="persons_contacts[${count}][last_name]" class="form-control col-md-6" placeholder="Last Name">
					</div>
					<div class="person-contact">
                    <input type="tel" name="persons_contacts[${count}][nickname]" class="form-control col-md-6" placeholder="Nickname">
                    <input type="tel" name="persons_contacts[${count}][position]" class="form-control col-md-6" placeholder="Position">
					</div>
                </div>
            </div>
            <div class="form-group row contact-row">
                <label for="persons_contacts[${count}][land_line][country_code]" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Land Line </label>
                <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">
                    <input type="text" name="persons_contacts[${count}][land_line][country_code]" class="form-control col-md-3" placeholder="Country Code">
                    <input type="text" name="persons_contacts[${count}][land_line][area]" class="form-control col-md-3" placeholder="Area">
                    <input type="tel" name="persons_contacts[${count}][land_line][number]" class="form-control col-md-3" placeholder="Number">
                    <input type="text" name="persons_contacts[${count}][land_line][extention]" class="form-control col-md-3" placeholder="Extention">
                </div>
            </div>
            <div class="form-group row contact-row" id="mobile-field">
                <label for="mobile" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Mobile </label>
                <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">
                    <select name="persons_contacts[${count}][mobile][0][type]" class="form-control select2 select-input-field color-change col-md-3 " style="width: 100%;">
                        <option value="">Select Type</option>
                        <option value="main">Main</option>
                        <option value="work">Work</option>
                        <option value="whatsapp">Whatsapp</option>
                    </select>
                    <input type="text" name="persons_contacts[${count}][mobile][0][area]" class="form-control col-md-3" placeholder="Area">
                    <input type="tel" name="persons_contacts[${count}][mobile][0][number]" class="form-control col-md-3" placeholder="Number">
                    <input type="tel" name="persons_contacts[${count}][mobile][0][extention]" class="form-control col-md-3" placeholder="Extention">
                </div>
            </div>
            <a href="javascript:void(0)" class="mobile-clone float-right mr-5" data-count="0">Add Another Mobile</a>
            <br>
			<br>
            <div class="form-group row email-field">
                <label for="email" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Email </label>
                <div class="col-lg-9 col-md-9 col-sm-8">
                    <input type="email" name="persons_contacts[${count}][email]" class="form-control" placeholder="Enter Email" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="persons_contacts[${count}][notes]" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Notes </label>
                <div class="col-lg-9 col-md-9 col-sm-8">
                    <textarea name="persons_contacts[${count}][notes]" class="form-control" placeholder="Notes"></textarea>
                </div>
            </div>
            <div class="form-group row attachment-contact-edit-row">
                <label for="persons_contacts[${count}][attachment][]" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Attachment </label>
                <div class="col-lg-9 col-md-9 col-sm-8 input-group">
                    <div class="custom-file">
                        <input type="file" name="persons_contacts[${count}][attachment][]" class="form-control custom-file-input" accept="image/*, .pdf, .doc" multiple>
                        <label class="custom-file-label" for="attachment">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="user_defined" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Addition filed user defined </label>
                <div class="col-lg-9 col-md-9 col-sm-8">
                    <input type="text" name="persons_contacts[${count}][user_defined]" class="form-control" placeholder="Enter Addition filed user defined" value="">
                </div>
            </div>
        </div>
        `;
		$(form).insertBefore(this);
	});

	$(document).on('click', '#add_website', function () {
		var count = parseInt($(this).attr('data-count')) + 1;
		$(this).attr('data-count', count);
		var form = `
        <div id="website_information${count}">
            <label>
                <h4 class="modal-title mt-2 mb-1">Website Information ( ${count+1} )
                <a href="javascript:void(0)" class="removeEle" data-id="website_information${count}" data-btn="add_website">Remove</a>
                </h4>
            </label>
            <div class="form-group row">
                <label for="title" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Title </label>
                <div class="col-lg-9 col-md-9 col-sm-8">
                    <input type="text" name="website_information[${count}][title]" class="form-control" placeholder="Enter Title" value="" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="link" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Link </label>
                <div class="col-lg-9 col-md-9 col-sm-8">
                    <input type="url" name="website_information[${count}][link]" class="form-control" placeholder="Enter Link" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-lg-3 col-md-3 col-sm-4 col-form-label">User Name </label>
                <div class="col-lg-9 col-md-9 col-sm-8">
                    <input type="text" name="website_information[${count}][username]" class="form-control" placeholder="Enter User Name" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Password </label>
                <div class="col-lg-9 col-md-9 col-sm-8">
                    <input type="password" name="website_information[${count}][password]" class="form-control" placeholder="Enter Password" value="">
                </div>
            </div>
        </div>
        `;
		$(form).insertBefore(this);
	});

	$(document).on('click', '#add_address', function () {
		var count = parseInt($(this).attr('data-count')) + 1;
		$(this).attr('data-count', count);
		var countryList = JSON.parse($('#countryList').val());

		var form = `
        <div class="form-group row address-contact-row" id="address${count}">
            <label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Address ( ${count+1} )
            <a href="javascript:void(0)" class="removeEle" data-id="address${count}" data-btn="add_address">Remove</a>
            </label>
            <div class="col-lg-9 col-md-9 col-sm-8 contact-address-fields">
                <input type="text" name="contact[address][${count}][name]" class="form-control" placeholder="Address Name (e.g Head Office, Postal...etc)" value="">
                <input type="text" name="contact[address][${count}][address_line_1]" class="form-control" placeholder="Address Line 1">
                <input type="text" name="contact[address][${count}][address_line_2]" class="form-control" placeholder="Address Line 2">
                <div class="address-city-post-code">
                <input type="text" name="contact[address][${count}][city]" class="form-control" placeholder="City">
                <input type="text" name="contact[address][${count}][post_code]" class="form-control" placeholder="Post Code">
				</div>`;

		form += `<select name="contact[address][${count}][country]" class="form-control select2 select-input-field color-change">`;
		form += `<option value="">Select Country</option>`;
		$.each(countryList, function (key, val) {
			form += `<option value="${key}">${val}</option>`;
		});
		form += `</select>`;
		form += `
                <input type="text" name="contact[address][${count}][google_map_link]" class="form-control" placeholder="Google Map Link">
            </div>
        </div>
        `;
		$(form).insertBefore(this);
	});

	$(document).on('click', '.removeEle', function () {
		var ele = $(this).attr('data-id');
		var btn = $(this).attr('data-btn');
		var count = parseInt($(`#${btn}`).attr('data-count')) - 1;
		$(`#${btn}`).attr('data-count', count);
		$(`#${ele}`).remove();
	});

	// Contacts list DataTable
	window.contacts = $('table#contacts_table').DataTable({
		processing: true,
		serverSide: false,
		aaSorting: [[0, 'ASC']],
		"ajax": {
			"url": "/contact",
		},
		columnDefs: [{
			'searchable': false,
			"orderable": false,
			'targets': [0,5,6,7],
        }],
		columns: [
			{
				data: 'select'
			},
			{
				data: 'name'
			},
			{
				data: 'website'
			},
			{
				data: 'email'
			},
			{
				data: 'phone'
			},
            {
				data: 'attachment'
			},
			{
				data: 'tags'
			},
			{
				data: 'action'
			},
        ]
	});

	// Archive list DataTable
	window.archive = $('table#archive_table').DataTable({
		processing: true,
		serverSide: false,
		aaSorting: [[0, 'ASC']],
		"ajax": {
			"url": "/archive",
		},
		columnDefs: [{
			'searchable': false,
			"orderable": false,
			'targets': [0,5,6,7],
        }],
		columns: [
			{
				data: 'select'
			},
			{
				data: 'name'
			},
			{
				data: 'website'
			},
			{
				data: 'email'
			},
			{
				data: 'phone'
			},
            {
				data: 'attachment'
			},
			{
				data: 'tags'
			},
			{
				data: 'action'
			},
        ]
	});

	// Group list DataTable
	window.groupTable = $('table#group_table').DataTable({
		processing: true,
		serverSide: false,
		aaSorting: [[0, 'ASC']],
		"ajax": {
			"url": $(this).data('href'),
		},
		columnDefs: [{
			'searchable': false,
			"orderable": false,
			'targets': [0,5,6,7],
        }],
		columns: [
			{
				data: 'select'
			},
			{
				data: 'name'
			},
			{
				data: 'website'
			},
			{
				data: 'email'
			},
			{
				data: 'phone'
			},
            {
				data: 'attachment'
			},
			{
				data: 'tags'
			},
			{
				data: 'action'
			},
        ]
	});

    // Activity Log List
    activity_log_table = $('#activity_log_table').DataTable({
        processing: true,
        serverSide: false,
        searching: false,
        "ajax": {
            "url": `/contact-log/${$('#contactId').val()}`,
        },
        columnDefs: [{
            'orderable'     : false,
            'targets'       : [0,1,2,3],
        }],
        columns: [
            { data: 'select'},
            { data: 'title'},
            { data: 'description'},
            { data: 'activity_by'},
            { data: 'date'},
        ]
    });

	// Ajax Action performer
	function actionAjaxContactOption(url, rows, table = "") {
		$.ajax({
			data: {
				rows
			},
			url: url,
			type: 'POST',
			beforeSend: function (request) {
				return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
			},
			success: function (response) {
				if (table != "") {
					table.ajax.reload();
				}
				return true;
			}
		});
	}

	// Add Tag Submit handler
	$('#tag-form').submit(function (e) {
		e.preventDefault();
		$.ajax({
			data: $(this).serialize(),
			url: '/tag-contact',
			type: 'POST',
			beforeSend: function (request) {
				$('#add-tag-modal').modal('hide');
				return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
			},
			success: function (response) {
				if (response.success == 1) {
					toastr.success(response.msg);
				} else {
					toastr.error(response.msg);
				}
				contacts.ajax.reload();
				var pageURL = window.location.href;
				var lastURLSegment = pageURL.substr(pageURL.lastIndexOf('/') + 1);
				if ( $.isNumeric(lastURLSegment) ) { window.location.reload(); }
			}
		});
		this.reset();
	});

	// Load Websites
	websites = $('#website_table').DataTable({
		processing: true,
		serverSide: false,
		aaSorting: [[0, 'desc']],
		"ajax": {
			"url": "/contact-websites",
			"data": function (d) {
				d.id = $('#contactId').val();
			}
		},
		columnDefs: [{
			'searchable': false,
			'orderable': false,
			'targets': [0, 4, 5, 6],
        }],
		columns: [
			{
				data: 'select'
			},
			{
				data: 'title'
			},
			{
				data: 'link'
			},
			{
				data: 'username'
			},
			{
				data: 'password'
			},
			{
				data: 'passwordView'
			},
			{
				data: 'action'
			},
        ]
	});

	// Load Persons Table
	contactPersonsTable = $('#contact_persons_table').DataTable({
		processing: true,
		serverSide: false,
		aaSorting: [[0, 'desc']],
		"ajax": {
			"url": "/contact-persons",
			"data": function (d) {
				d.id = $('#contactId').val();
			}
		},
		columnDefs: [{
			'searchable': false,
			'orderable': false,
			'targets': [0, 4, 5, 6],
        }],
		rowGroup: {
			dataSrc: 'group'
		},
		columns: [
			{
				data: 'select'
			},
			{
				data: 'name'
			},
			{
				data: 'nickname'
			},
			{
				data: 'position'
			},
			{
				data: 'contact'
			},
			{
				data: 'notes'
			},
			{
				data: 'attachment'
			},
        ]
    });

    // Attachment View Modal action
    $(document).on('click', '.attachment-view-btn', function(){
        var fileType = $(this).data('file-type');
        var id = $(this).data('id');

        $('#attachmentUploadType').val(fileType);
        $('#attachmentUploadId').val(id);
        var files = JSON.parse( $(this).attr('data-files') );
        var html = `<ul>`;
        $(files).each(function(index,file){
            var ext = file.split('.').pop();
            var deleteBtn = ( $('#permission').val() == "true") ? `<button class="attachment-delete-btn" data-type="${fileType}" data-id="${id}" data-file="${file}">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>`:"";
            switch (ext) {
                case 'pdf':
                    html += `<li><a href="/${file}" target="_blank" class="attachment-link">${deleteBtn}<i class="far fa-file-pdf"></i>
                    </a></li>`;
                break;
                case 'jpg': case 'jpeg': case 'png': case 'gif':
                    html += `<li><a href="/${file}" target="_blank" class="attachment-link">${deleteBtn}<img src="${siteurl}/${file}" class="img-thumbnail" width="50" height="50">
                    </a></li>`;
                break;
                case 'word':
                    html += `<li><a href="/${file}" target="_blank" class="attachment-link">${deleteBtn}<i class="far fa-file-word"></i></a></li>`;
                break;
                default:
                    html += `<li><a href="/${file}" target="_blank" class="attachment-link">${deleteBtn}<i class="far fa-file-pdf"></i></a></li>`;
                break;
            }
        });
        html += `<ul>`;

        $('#attachment-view-modal').html(html);
    });

    // Upload Attachment
    $(document).on('click', '.upload-attachment', function(){
        $('#uploadFiles').trigger('click');
    });

    $(document).on('change','#uploadFiles', function(){
        $('#attachmentUploadForm').submit();
    });

    // Person View Modal action
    $(document).on('click','.person-contact-view',function(){
        var contact = JSON.parse( $(this).attr('data-contact') );
        var html = `<div class="cont-eng d-flex justify-content-between">
                <div class="cont-eng-left">
                    <h4>${contact.name}</h4>
                    <p>
                        <span>${contact.position}</span>
                        <font>|</font>
                        <span>${contact.nickname}</span>
                    </p>
                </div>

            </div>`;
		html += `<div class="cont-eng-list">
                <ul>`;
        html += `<div class='landline-ext-list'>`;
		if (Object.keys(contact.land_line).length) {
			html += `<li class="w-75">
                    <span>land Line</span>
                    <a href="tel:${contact.land_line.country_code}${contact.land_line.number}"><i class="fas fa-phone-alt"></i>${contact.land_line.country_code}${contact.land_line.number}</a>
                </li>`;
			if (contact.land_line.extention != '') {
				html += `<li class="w-50">
                        <span>Ext</span>
                        <a href="tel:${contact.land_line.country_code}${contact.land_line.extention}"><i class="fas fa-phone-alt"></i>${contact.land_line.country_code}${contact.land_line.extention}</a>
                    </li>`;
			}
		}
		html += `</div>`;

		if (Object.keys(contact.mobile).length) {
			html += `
                <li class="mobile-person-contact-view">
                <span>Mobile</span>
                `;
                html +=`<div class="mobile-tyle-box">`
			$.each(contact.mobile, function (index, value) {
				html += `<span class='mobile-type'>${ (value.type == null)?'':value.type }<a href="tel:${ (value.extention == null)?'':value.extension }${(value.number == null)?'':value.number}"><i class="fas fa-phone-alt"></i>${(value.extention == null)?'':value.extention } ${ (value.number == null)? '':value.number }</a></span><br>`;
			});
			html +=`</div>`
		}

		if (contact.email.trim().length) {
			html += `<li class="email-person-contact-view">
                        <span>Emails</span>
                        <a href="${contact.email}"><i class="fa fa-at"></i>${contact.email}</a>
                    </li>`;
		}

		if (contact.notes.trim().length) {
			html += `<li class="notes-person-contact-view">
                        <label for="exampleFormControlTextarea1"> Notes</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2">${contact.notes}</textarea>
                        <button type='button' class='btn attachment-view-btn attachment-view-btn-modal-hide' data-toggle='modal' data-target='#attachment-view' data-files='${ JSON.stringify(contact.attachment) }' data-file-type='contactInformation' data-id='${contact.id}'>
				            <i class='far fa-file-alt'></i>${(contact.attachment) ? contact.attachment.length : 0}
				        </button>
                    </li>`;
            }

        $('#contact-view-modal').html(html);
    });

    $(document).on('click','.attachment-view-btn-modal-hide',function(){
    	$('#person-cont-view').modal('hide');
    });
    // Website Form Submit handler
    $(document).on('submit','#add-website-form', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response){
                if (response.success == 1) {
                    toastr.success(response.msg);
                }else{
                    toastr.error(response.msg);
                }
                $('#add-website-modal').modal('hide');
                websites.ajax.reload();
            }
        });
        this.reset();
    });

    // Add Group Submit handler
    $('#group-form').submit(function(e){
      var org_id=$('.org_id').val();
        e.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: '/organisation/'+org_id+'/group-contact',
            type: 'POST',
            beforeSend: function (request) {
                $('#myModal').modal('hide');
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){
                if (response.success == 1) {
                    toastr.success(response.msg);
                }else{
                    toastr.error(response.msg);
                }
                var table = $('input[name="table"]').val();
                if ( table == "contactPersonsTable" ) {
                    contactPersonsTable.ajax.reload();
                }
                contacts.ajax.reload();
            }
        });
        this.reset();
    });

    // Table Action performer
    $('.option').click(function(e){

        e.preventDefault();
        var id = $(this).data('id');
        var action = $(this).data('type');
        var rows = [];
        $('.row-select').each(function(){
            if($(this).is(":checked")){
                rows.push(this.value)
            }
        });


        if(rows.length <= 0 ){
            toastr.error('Please select atleast one row.');
            return false;
        }

        var url = $(this).attr('href');

        switch ($(this).attr('data-type')) {
            case "archive":
                actionAjaxContactOption(url,rows,contacts);
                break;
            case "contact":
                actionAjaxContactOption(url,rows,archive);
                break;
            case "merge":
                $.ajax({
                    data: {rows},
                    url: url,
                    type: 'POST',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response){
                        $('#modal-div').html(response);
                        $('#contact-merge-modal').modal('show');
                        $('#merge-selected-row').val(rows);
                    }
                });
                break;
            case "group":

                $('#group-selected-row').val(rows);
                $('#myModal').modal('show');
                break;
            case "tag":
                $('#tag-selected-row').val(rows);
                $('#add-tag-modal').modal('show');
                break;
            case "website-delete":
                actionAjax(url,rows,websites);
                break;
            case "website-archive":
                actionAjax(url,rows,websites);
                break;
            case "person-assign-group":
                $('#group-selected-row').val(rows);
                $('#group-selected-row').after('<input type="hidden" name="type" value="person"><input type="hidden" name="table" value="contactPersonsTable">');
                $('#myModal').modal('show');
                break;
            case "person-remove-group":
                actionAjax(url,rows,contactPersonsTable);
                break;
            case "contact-information-delete":
                actionAjax(url,rows,contactPersonsTable);
                break;
            case "group-archive": case "group-active":
                var res = actionAjax(url,rows,group_list);
                break;
            case "group-merge":
                $.ajax({
                    data: {rows},
                    url: url,
                    type: 'POST',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response){
                        $('#modal-div').html(response);
                        $('#group-merge-modal').modal('show');
                    }
                });
            break;
        }
    });

    // Ajax Action performer
    function actionAjax(url,rows,table=""){
        $.ajax({
            data: {rows},
            url: url,
            type: 'POST',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){
                if (response.success == 1) {
                    toastr.success(response.msg);
                }else{
                    toastr.error(response.msg);
                }
                if (table != "") {
                    table.ajax.reload();
                }
            }
        });
    }

    // View Pin Modal
    $(document).on('click','.view-pin',function(){
        var row = $(this).data('id');
        $('#pinrowId').val(row);
        if ( $(`#pin-id-${row}`).attr('data-view') == 'false' ) {
        	$('#watch').modal('show');
        }else{
        	$(`#pswd-tab-${row}`).html('***********');
        	$(`#pin-id-${row}`).html('<i class="fa fa-eye"></i>');
        	$(`#pin-id-${row}`).attr('data-view','false')

        }
    });

    //View Pin Action
    $('#pin-code-form').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/view-website-pin",
            data: $(this).serialize(),
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){
                if (response.success == 1) {
                    $(`#pswd-tab-${response.id}`).html(response.data);
                    toastr.success(response.msg);
                    $(`#pin-id-${response.id}`).html('<i class="fa fa-eye-slash"></i>');
                    $(`#pin-id-${response.id}`).attr('data-view','true');
                }else{
                    toastr.error(response.msg);
                    $(`#pin-id-${response.id}`).html('<i class="fa fa-eye"></i>');
                }
                $('#watch').modal('hide');
            }
        });
        this.reset();
    });

    $('.show-contact-option').click(function(){
        var row = $(this).data('row');
        switch ($(this).attr('data-type')) {
            case "archive":
                url = '/contact-archive';
                actionAjax(url,[row],contacts);
                activity_log_table.ajax.reload();
                break;
            case "contact":
                url = '/archive-contact';
                actionAjaxContactOption(url,row,archive);
                break;
            case "group":
                $('#group-selected-row').val(row);
                $('#myModal').modal('show');
                break;
            case "tag":
                $('#tag-selected-row').val(row);
                $('#add-tag-modal').modal('show');
                break;
            case "merge":
                $.ajax({
                    data: {'rows[]':row},
                    url: "/contact-merge",
                    type: 'POST',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response){
                        if (response.success == 0) {
                            toastr.error(response.msg);
                        }else{
                            $('#modal-div').html(response);
                            $('#contact-merge-modal').modal('show');

                        }
                    }
                });
            break;
        }
    });

    $(document).on('change', '#contact-select-merge', function(){
        var rows = JSON.parse($('#merge-selected-row').val());
        if (rows.includes( $(this).val() )) {
            toastr.error("Please Select another conatct or create new contact because this contact selected for merge.");
            $('#contact-merge-form').find(':button[type=submit]').prop('disabled', true);
        }else{
            $('#contact-merge-form').find(':button[type=submit]').prop('disabled', false);
        }
    });

    $(document).on('click','.download-attachment', function(){
        $('.attachment-link').each(function(){
            var url = $(this).attr("href");
            download(url);
        });
    });

    function download(url) {
        const a = document.createElement('a')
        a.href = url
        a.download = url.split('/').pop()
        document.body.appendChild(a)
        a.click()
        document.body.removeChild(a)
    }

    // Notes List
    notes = $('#notes_table').DataTable({
        processing: true,
        serverSide: false,
        ordering: false,
        "ajax": {
            "url": `/contact-notes/${$('#notes_table').data('contact-id')}`,
            "data": function ( d ) {
                d.id = $('#contactId').val();
                d.status = $(".note-filter.active").attr('data-value');
            }
        },
        columnDefs: [{
            'orderable'     : false,
            'targets'       : [0,1,2],
        }],
        columns: [
            { data: 'select'},
            { data: 'title'},
            { data: 'details'},
        ]
    });

    // Notes Delete
    $(document).on('click', '#notes_table .row-select', function(){
        var arr = [];
        $('.row-select').map(function(){
            if (this.checked) {
                arr.push(this.value);
            }
        });
        $('#notes-delete-ids').val( JSON.stringify(arr) );
    });

    // Pin Note On Top
    $(document).on('click', '.pin-note', function(){
        $.ajax({
            data: { 'id' : this.value , 'contact_id' : $('#contactId').val() },
            url: '/contact-pin-note',
            type: 'POST',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){
                if (response.success == 1) {
                    toastr.success(response.msg);
                }else{
                    toastr.error(response.msg);
                }
                notes.ajax.reload();
            }
        });
    });

    // Edit Note
    $(document).on('click', '.edit-note', function(){
        var data = $(this).data('value');
        if (Object.keys(data).length) {
            var contactId = $('#contactId').val();
            var csrf = $("meta[name='csrf-token']").attr('content');
            html = `
                <input type="hidden" name="_token" value="${csrf}">
                <input type="hidden" name="id" value="${data.id}">
                <input type="hidden" name="contact_id" value="${contactId}">
                <div class="form-group">
                    <label for="title" class="col-form-label">Title:</label>
                    <input type="text" class="form-control" name="title" value="${data.title}">
                </div>
                <div class="form-group">
                    <label for="link" class="col-form-label">Description:</label>
                    <textarea class="form-control" name="description">${(data.description != 'null' && data.description != null)?data.description:''}</textarea>
                </div>
                <div class="form-group">
                    <label for="username" class="col-form-label">Attachment:</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="attachment[]" class="form-control custom-file-input" multiple>
                            <label class="custom-file-label" for="logoFile">Choose file</label>
                            @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!-- div class="custom-file">
                        <input type="file" class="form-control custom-file-input" name="attachment[]" multiple>
                    </div> -->
                </div>
            `;
            $('#edit-note-modal .modal-body').html(html);
            $('#edit-note-modal').modal('show');
        }else{
            $('#edit-note-modal .modal-body').html('');
        }
    });

    // Activity Log Delete
    $(document).on('click', '#activity_log_table .row-select', function(){
        var arr = [];
        $('.row-select').map(function(){
            if (this.checked) {
                arr.push(this.value);
            }
        });
        $('#activity-log-delete-ids').val( JSON.stringify(arr) );
    });

    // Attachment Delete
    $(document).on('click', '.attachment-delete-btn', function(e){
        e.preventDefault();
        $.ajax({
            data: {
                'id' : $(this).data('id'),
                'type' : $(this).data('type'),
                'file' : $(this).data('file')
            },
            url: '/contact-delete-attachment',
            type: 'DELETE',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){
                if (response.success == 1) {
                    $(this).parent().remove();
                    $(this).remove();

                    $('#attachment-view').modal('hide');

                    if( $("#contacts_table").length ) {
                        contacts.ajax.reload();
                    }
                    if( $("#contact_persons_table").length ) {
                        contactPersonsTable.ajax.reload();
                    }
                    if( $("#notes_table").length ) {
                        notes.ajax.reload();
                    }

                    if( $("#archive_table").length ) {
                        archive.ajax.reload();
                    }

                    if( $("#group_table").length ) {
                        groupTable.ajax.reload();
                    }

                    toastr.success(response.msg);
                }else{
                    toastr.error(response.msg);
                }
                notes.ajax.reload();
            }
        });
    });
    // Edit tag
    $(document).on('click','.edit-tag', function(e){
        var tagName = $(this).data("tag-name");
        var tagIndex = $(this).data("tag-index");
        var contactId = $('#contactId').val();
        if(tagName != ''){
            var csrf = $("meta[name='csrf-token']").attr('content');
            html= `<div class="form-tag">
                        <input type="hidden" name="_token" value="${csrf}">
                        <input type="hidden" name="id" value="${contactId}">
                        <input type="hidden" name="tagIndex" value="${tagIndex}">
                        <label for="tag-name" class="col-form-label">Tag Name:</label>
                        <input type="text" name="tag" class="form-control" value="${tagName}">
                    </div>
                    `;
            $('#edit-tag-modal .modal-body').html(html);
            $('#edit-tag-modal').modal('show');
        }else{
            $('#edit-tag-modal .modal-body').html('');
        }
    });

    // Archive Note
    $(document).on('click','#archive-note', function(e){
        var ids = [];
        $('#notes_table .row-select').map(function(){
            if (this.checked) {
                ids.push(this.value);
            }
        });
        if (ids.length > 0) {
            $.ajax({
                data: {
                    'ids' : ids,
                },
                url: '/archive-notes',
                type: 'POST',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response){
                    if (response.success == 1) {
                        notes.ajax.reload();
                        toastr.success(response.msg);
                    }else{
                        toastr.error(response.msg);
                    }
                }
            });
        }else{
            toastr.error("Select atleast one note.");
        }
    });

    // Sort notes and activity by status
    $(document).on('change','#sortBy',function(){
        notes.ajax.reload();
    });
    // select box
	$('.select-input-field').each(function() {
	    if($(this).val() == ''){
	    	$(this).addClass('color-change');
	    }
	 });
	$(document).on('change', '.select-input-field' , function(){
        $(this).removeClass('color-change')
        var val = $(this).find('option:selected').val();
        if(val == ''){
            $(this).addClass('color-change');
        }
    });

    // Group list DataTable
    var org_id=$('.org_id').val();
	window.group_list = $('table#group_list_table').DataTable({
		processing: true,
		serverSide: false,
		aaSorting: [[0, 'ASC']],
		"ajax": {
			url: '/organisation/'+org_id+'/group',
            data: function (d) {
				d.type = $(".group-filter.active").attr('data-value');
			}
		},
		columnDefs: [{
			'searchable': false,
			"orderable": false,
			'targets': [0, 3],
        }],
		columns: [
			{
				data: 'select'
			},
			{
				data: 'title'
			},
			{
				data: 'parent'
			},
            {
				data: 'action'
			},
        ]
	});

    $(document).on('click','.group-edit',function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response){
                $('#edit-group-modal .modal-content').html('');
                if (response.success == 1) {
                    $('#edit-group-modal .modal-content').html(response.msg);
                    $('#edit-group-modal').modal('show');
                }else{
                    toastr.error(response.msg);
                }
            }
        });
    });

    $(document).on('click','.group-filter',function(){
        $('.group-filter').removeClass('active');
        $(this).addClass('active');
        if ($(this).html() == 'Archive') {
            $('#group-option-archive').attr('href','/group-active');
            $('#group-option-archive').attr('data-value','active');
            $('#group-option-archive').html('Active');
        }else{
            $('#group-option-archive').attr('href','/group-archive');
            $('#group-option-archive').attr('data-value','archive');
            $('#group-option-archive').html('Archive');
        }
        group_list.ajax.reload();
    });

    $(document).on('click','.note-filter',function(){
        $('.note-filter').removeClass('active');
        $(this).addClass('active');
        notes.ajax.reload();
    });
      $(document).on('click','.filter', function(e){

        table.search(this.value).draw();
          // var filter_value=[];
          // $('.filter').each(function(){
          //     if($(this).prop("checked") == true)
          //     {
          //       filter_value.push($(this).val());
          //     }
          //
          //
          // });
          //
          // var org_id=$('.org_id').val();
          // $.ajax({
          //     type: "get",
          //     url: '/organisation/'+org_id+'/contact/',
          //     data: {'filter_value':filter_value},
          //     success: function(response){
          //
          //     }
          // });
      })
});
