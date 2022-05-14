import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import auth from './auth/index.js';
import companies from './company/index.js';
// import employees from './employees/index.js';

const store = new Vuex.Store({
  modules: {
    auth,
    companies,
  },
  state() {
    return {
      baseUrl: 'http://localhost:8000/storage',
      main_company: 'الشركة الرئيسية',
      name: 'الاسم الانجليزي',
      main_company_details: 'تفاصيل الشركة الرئيسية',
      sub_company_details: 'تفاصيل الشركة الفرعية',
      arabicName: 'الاسم العربي',
      license_number: 'رقم الترخيص',
      central_number: 'رقم المركز',
      civil_authority_number: 'رقم المحكمة',
      commercial_register_number: 'رقم السجل التجاري',
      address_automatic_number: 'رقم العنوان الآلي',
      date_of_issuance_of_license: 'تاريخ الإصدار',
      created_at: 'تاريخ الإضافة',
      expired_at: 'تاريخ الانتهاء',
      license_address: 'عنوان الترخيص',
      address: 'العنوان ',
      description: 'الوصف',
      file_number: 'رقم الملف',
      enterName: 'ادخل الاسم باللغة الانجليزية',
      enterArabicName: 'ادخل الاسم باللغة العربية',
      enterLicenseNumber: 'ادخل رقم الترخيص',
      enterCentralNumber: 'ادخل رقم المركز',
      enterCivilAuthorityNumber: 'ادخل رقم المحكمة',
      enterCommercialRegisterNumber: 'ادخل رقم السجل التجاري',
      enterAddressAutomaticNumber: 'ادخل رقم العنوان الآلي',
      enterDateOfIssuanceOfLicense: 'ادخل تاريخ الإصدار',
      enterExpiredAt: 'ادخل تاريخ الانتهاء',
      enterLicenseAddress: 'ادخل عنوان الترخيص',
      enterAddress: 'ادخل عنوان الشركة',
      enterDescription: 'ادخل الوصف',
      enterFileNumber: 'ادخل رقم الملف',
      enterMainCompany: 'ادخل الشركة الرئيسية',
      enterSubCompany: 'ادخل الشركة الفرعية',
      add: 'إضافة',
      clear: 'مسح',
      edit: 'تعديل',
      delete: 'حذف',
      cancel: 'إلغاء',
      save: 'حفظ',
      chooseFiles: 'اختر الملفات',
      attachments: 'المرفقات',
      dropAttachments: 'إسقاط المرفقات',
      browse: 'استعراض',
      upload: 'رفع',
      errorAdd: 'خطأ في الإضافة',
      errorUpdate: 'خطأ في التعديل',
      errorDelete: 'خطأ في الحذف',
      errorClear: 'خطأ في المسح',
      errorUpload: 'خطأ في الرفع',
      successAdd: 'تمت الإضافة بنجاح',
      successUpdate: 'تم التعديل بنجاح',
      successDelete: 'تم الحذف بنجاح',
      successClear: 'تم المسح بنجاح',
      successUpload: 'تم الرفع بنجاح',
      confirmDelete: 'هل انت متأكد من الحذف؟',
      delete_confirmation: 'تأكيد الحذف',
      confirm: 'تأكيد',
      actions: 'الإجراءات',
      main_companies: 'الشركات الرئيسية',
      sub_companies: 'الشركات الفرعية',
      sub_company: 'الشركة الفرعية',
      employees: 'الموظفين',
      employee: 'الموظف',
      employees_of_company: 'الموظفين التابعين للشركة',
      email: 'البريد الإلكتروني',
      nationality: ' الجنسية باللغة الانجليزية',
      nationality_ar: 'الجنسية باللغة العربية',
      enterNationality: 'ادخل الجنسية باللغة الاجنبية',
      enterNationalityAr: 'ادخل الجنسية باللغة العربيه',
      passport_number: 'رقم الباسبور',
      enterPassportNumber: 'ادخل رقم الباسبور',
      city: 'المدينة',
      enterCity: 'ادخل المدينة',
      country: 'البلد',
      enterCountry: 'ادخل البلد',
      postal_code: 'الرمز البريدي',
      enterPostalCode: 'ادخل الرمز البريدي',
      civil_id: 'البطاقة المدنية',
      passport_expiry_date: 'تاريخ انتهاء صلاحية جواز السفر',
      enterPassportExpiryDate: 'ادخل تاريخ انتهاء صلاحية جواز السفر',
      residence_expiry_date: 'تاريخ انتهاء صلاحية الإقامة',
      enterResidenceExpiryDate: 'ادخل تاريخ انتهاء صلاحية الإقامة',
      enterEmployeeAddress: 'ادخل عنوان الموظف تفصيليا',
      userDetails: 'تفاصيل الموظف',
      no_company: 'لا يوجد شركات',
      no_sub_company: 'لا يوجد شركات فرعية',
      menu: 'القائمة',
      liabilities: 'الخصوصيات',
      profile: 'الملف الشخصي',
      setting: 'الإعدادات',
      enterEmail: 'ادخل البريد الإلكتروني',
      supervisor: 'المشرف',
      enterSupervisor: 'ادخل المشرف',
      avatar: 'الصورة الرمزية',
      enterCivilId: 'ادخل رقم البطاقة المدنية',
      phoneNumbers: 'أرقام الهاتف',
      phoneNumber: 'رقم الهاتف',
      enterFirstPhoneNumber: 'ادخل رقم الهاتف الأول',
      enterSecondPhoneNumber: 'ادخل رقم الهاتف الثاني',
      enterThirdPhoneNumber: 'ادخل رقم الهاتف الثالث',
      no_phone_number: 'لا يوجد أرقام الهاتف',
      no_attachment: 'لا يوجد مرفقات',
      logout: 'تسجيل الخروج',
      login: 'تسجيل الدخول',
      liabilities: 'الخصومات',
      id: 'الرقم',
      amount: 'المبلغ',
      remaining_amount: 'المبلغ المتبقي',
      paid: 'مدفوع',
      unpaid: 'غير مدفوع',
      na: 'غير متوفر',
      status: 'الحالة',
      original_amount: 'المبلغ الاصلى',
      completed: 'مكتمل',
      uncompleted: 'غير مكتمل',
      emp_name: 'اسم الموظف',
      enterEmpName: 'ادخل اسم الموظف',
      product: 'المنتج',
      enterProduct: 'ادخل المنتج',
      total_amount: 'المبلغ الإجمالي',
      enterTotalAmount: 'ادخل المبلغ الإجمالي',
      remaining_amount: 'المبلغ المتبقي',
      enterRemainingAmount: 'ادخل المبلغ المتبقي',
      date: 'التاريخ',
      yes: 'نعم',
      no: 'لا',
      is_paid: 'حالة الدفع',
      enterIsPaid: 'ادخل حالة الدفع',
      required_amount: 'المبلغ المطلوب',
      enterRequiredAmount: 'ادخل المبلغ المطلوب',
      errorEquality: 'المبلغ الكلى يجب ان يساوى المبلغ المطلوب',
    };
  },
});

export default store;
