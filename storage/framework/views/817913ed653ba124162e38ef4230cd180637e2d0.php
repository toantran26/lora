<?php if($object->lastPage() > 1): ?>
<div aria-label="Page navigation example" class="navigatio_page">
  <ul class="pagination">
    <li class="page-item">
      <?php if($object->currentPage() != 1): ?>
      <a class="page-link" href="<?php echo e($object->previousPageUrl()); ?>"><i class="fas fa-chevron-left"></i>
      </a>
      <?php endif; ?>

    </li>
    <?php for($i = 1; $i <= $object->lastPage(); $i++): ?>
      <?php if(($i < $object->currentPage() +3 && $i > $object->currentPage() -3)
        || ($i > $object->currentPage() + 3 && $i < $object->currentPage() + 4)): ?>
        <li class="page-item <?php echo e($object->currentPage() == $i ? 'active' : ''); ?>">
          <a class="page-link" href="<?php echo e($object->url($i)); ?>"><?php echo e($i); ?>

          </a>
        </li>
      <?php endif; ?>
    <?php endfor; ?>
    <li class="page-item">
      <?php if($object->currentPage() != $object->lastPage()): ?>
      <a class="page-link" href="<?php echo e($object->nextPageUrl()); ?>"><i class="fas fa-chevron-right"></i>
      </a>
      <?php endif; ?>
    </li>
  </ul>
</div>
<?php endif; ?><?php /**PATH /Users/ap24h/Desktop/iot/resources/views/component/pagination-admin.blade.php ENDPATH**/ ?>