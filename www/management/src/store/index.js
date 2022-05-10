import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import auth from './auth/index.js';
import companies from './company/index.js';

const store = new Vuex.Store({
  modules: {
    auth,
    companies,
  },
  state() {
    return {
      baseUrl: 'http://localhost:8000/storage',
      main_company: 'الشركة الرئيسية',
      name: 'الاسم',
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
      address: 'عنوان الشركة',
      description: 'الوصف',
      file_number: 'رقم الملف',
      enterName: 'ادخل الاسم',
      enterArabicName: 'ادخل الاسم بالعربي',
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
    };
  },
});

export default store;
