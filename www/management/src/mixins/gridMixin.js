import {
  Page,
  Sort,
  Filter,
  Group,
  Toolbar,
  Search,
  PdfExport,
  ExcelExport,
  Resize,
  ColumnMenu,
  RowDD,
  Selection,
  DetailRow,
} from '@syncfusion/ej2-vue-grids';
import { L10n } from '@syncfusion/ej2-base';

export default {
  data() {
    return {
      toolbarOptions: ['Search', 'Print', 'PdfExport', 'ExcelExport'],
      pageSettings: { pageSize: 5 },
      groupOptions: { showGroupedColumn: true },
      filterSettings: { type: 'CheckBox' },

      selectionOptions: { type: 'Multiple' },
      srcDropOptions: { targetID: 'DestGrid' },
      destDropOptions: { targetID: 'Grid' },
      pageOptions: { pageSize: 7 },
      dateFormatOptions: { type: 'date', format: 'yyyy/MMM/d' },
    };
  },
  methods: {
    toolbarClick(args) {
      if (args.item.id === 'Grid_pdfexport') {
        this.$refs.grid.pdfExport();
      }

      if (args.item.id === 'LiabilityGrid_pdfexport') {
        console.log('pdf export');
        this.$refs.liabilityGrid.pdfExport();
      }

      if (args.item.id === 'Grid_excelexport') {
        this.$refs.grid.excelExport();
      }

      if (args.item.id === 'DestGrid_pdfexport') {
        this.$refs.destGrid.pdfExport();
      }

      if (args.item.id === 'Grid_excelexport') {
        this.$refs.grid.excelExport();
      }
      if (args.item.id === 'DestGrid_excelexport') {
        this.$refs.destGrid.excelExport();
      }
      if (args.item.id === 'LiabilityGrid_excelexport') {
        this.$refs.liabilityGrid.excelExport();
      }
    },
  },
  provide: {
    grid: [
      Page,
      Sort,
      Filter,
      Group,
      Toolbar,
      PdfExport,
      Search,
      Resize,
      ColumnMenu,
      RowDD,
      Selection,
      ExcelExport,
      DetailRow,
    ],
  },
};

L10n.load({
  ar: {
    grid: {
      EmptyRecord: 'لا سجلات لعرضها',
      EmptyDataSourceError:
        'يجب أن يكون مصدر البيانات فارغة في التحميل الأولي منذ يتم إنشاء الأعمدة من مصدر البيانات في أوتوجينيراتد عمود الشبكة',
      GroupDropArea: 'إسحب وأفلت حتى تجمع الأعمدة',
      UnGroup: 'إلغاء تجميع الأعمدة',
      Item: 'عنصر',
      Items: 'عناصر',
      totalItemsInfo: 'totalItemsInfo',
      totalItemInfo: 'عنصر',
      Search: 'بحث',
      Print: 'طباعة',
      Options: 'خيارات',
      Pdfexport: 'تصدير PDF',
      autoFitAll: 'تناسب تلقائي لكل الأعمدة',
      autoFit: 'تناسب تلقائي لهذا العمود',
      Group: 'تجميع حسب هذا العمود',
      Ungroup: 'إلغاء تجميع حسب هذا العمود',
      SortAscending: 'ترتيب تصاعدي',
      SortDescending: 'ترتيب تنازلي',
      Columnchooser: 'الأعمدة',
      SelectAll: 'اختيار الكل',
      ClearAll: 'مسح الكل',
      UnselectAll: 'إلغاء الاختيار',
      FilterButton: 'أدخل بحث',
      ClearButton: 'مسح البحث',
      FilterMenu: 'خيارات البحث',
      Excelexport: 'تصدير إلى Excel',
    },
    pager: {
      currentPageInfo: '{0} من {1} صفحة',
      totalItemsInfo: '({0} العناصر)',
      firstPageTooltip: 'انتقل إلى الصفحة الأولى',
      lastPageTooltip: 'انتقل إلى الصفحة الأخيرة',
      nextPageTooltip: 'انتقل إلى الصفحة التالية',
      previousPageTooltip: 'انتقل إلى الصفحة السابقة',
      nextPagerTooltip: 'الذهاب إلى بيجر المقبل',
      previousPagerTooltip: 'الذهاب إلى بيجر السابقة',
    },
  },
});
