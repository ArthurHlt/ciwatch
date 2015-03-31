<?php
$this->layout('layout.php', array('title' => 'CIWatch - Show'));
if (!($user instanceof \Sphring\MicroWebFramework\Model\User)) {
    exit();
}

?>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-12 watcher">
            <h1>
                <?php if (!$readOnly): ?>
                    <div class="control">
                        <a href="<?php echo $this->route('addRepo'); ?>" class="btn btn-default"><span
                                class="glyphicon glyphicon-plus"
                                aria-hidden="true"></span> Add repository</a>
                    </div>
                <?php endif; ?>
                Repositories
                watch <?php if ($readOnly): ?> for user
                    <strong><?php echo $user->getNickname(); ?></strong> <?php endif; ?>
            </h1>
            <hr>
            <?php if (!$showTable): ?>
                <div class="alert alert-info" role="alert">
                    <?php if (!$readOnly): ?>
                        You have no repositories to watch, add one in
                        <a href="<?php echo $this->route('addRepo'); ?>" class="alert-link">Add repository</a>
                    <?php else: ?>
                        This user has no repository
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="repeater" id="myRepeater">
                    <div class="repeater-header">
                        <div class="repeater-header-left">
                            <span class="repeater-title"></span>

                            <div class="repeater-search">
                                <div class="search input-group">
                                    <input type="search" class="form-control" placeholder="Search"/>
									<span class="input-group-btn">
									<button class="btn btn-default" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                        <span class="sr-only">Search</span>
                                    </button>
									</span>
                                </div>
                            </div>
                        </div>
                        <div class="repeater-header-right">
                            Organization:
                            <div class="btn-group selectlist repeater-filters" data-resize="auto">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="selected-label">&nbsp;</span>
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Filters</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li data-value="all" data-selected="true"><a href="#">All</a>
                                    </li>
                                    <?php foreach ($orgs as $org): ?>
                                        <li data-value="<?php echo $org; ?>"><a
                                                href="#"><?php echo ucfirst($org); ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                    <li data-value="others"><a href="#">Others</a>
                                    </li>
                                </ul>
                                <input class="hidden hidden-field" name="filterSelection" readonly="readonly"
                                       aria-hidden="true" type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class="repeater-viewport">
                        <div class="repeater-canvas"></div>
                        <div class="loader repeater-loader"></div>
                    </div>
                    <div class="repeater-footer">
                        <div class="repeater-footer-left">
                            <div class="repeater-itemization">
                                <span><span class="repeater-start"></span> - <span class="repeater-end"></span> of <span
                                        class="repeater-count"></span> items</span>

                                <div class="btn-group selectlist" data-resize="auto">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                        <span class="selected-label">&nbsp;</span>
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li data-value="5"><a href="#">5</a>
                                        </li>
                                        <li data-value="10" data-selected="true"><a href="#">10</a>
                                        </li>
                                        <li data-value="20"><a href="#">20</a>
                                        </li>
                                        <li data-value="50"><a href="#">50</a>
                                        </li>
                                    </ul>
                                    <input class="hidden hidden-field" name="itemsPerPage" readonly="readonly"
                                           aria-hidden="true" type="text"/>
                                </div>
                                <span>Per Page</span>
                            </div>
                        </div>
                        <div class="repeater-footer-right">
                            <div class="repeater-pagination">
                                <button type="button" class="btn btn-default btn-sm repeater-prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous Page</span>
                                </button>
                                <label id="myPageLabel" class="page-label">Page</label>

                                <div class="repeater-primaryPaging active">
                                    <div class="input-group input-append dropdown combobox">
                                        <input type="text" class="form-control" aria-labelledby="myPageLabel">

                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right"></ul>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" class="form-control repeater-secondaryPaging"
                                       aria-labelledby="myPageLabel">
                                <span>of <span class="repeater-pages"></span></span>
                                <button type="button" class="btn btn-default btn-sm repeater-next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next Page</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $this->start('javascript') ?>
                <script type="text/javascript">
                    var datas = <?php echo $items; ?>;
                    var columns = <?php echo $columns; ?>;
                    var dataFilter = function dataFilter(options) {
                        var items = $.extend([], datas);
                        var filterValue = new RegExp(options.filter.value, 'i');
                        if (!filterValue.test('all')) {
                            items = _.filter(items, function (item) {
                                var isFilterMatch = filterValue.test(item.org);
                                return isFilterMatch;
                            });
                        }
                        var searchTerm;
                        if (options.search) {
                            searchTerm = new RegExp(options.search, 'i');
                            items = _.filter(items, function (item) {
                                var itemText = _.reduce(_.values(_.omit(item, 'ThumbnailAltText', 'ThumbnailImage')), function (finalText, currentText) {
                                    return finalText + " " + currentText;
                                });
                                var isSearchMatch = searchTerm.test(itemText);
                                return isSearchMatch;
                            });
                        }
                        if (options.sortProperty) {
                            items = _.sortBy(items, function (item) {
                                if (options.sortProperty === 'id' || options.sortProperty === 'height' || options.sortProperty === 'weight') {
                                    return parseFloat(item[options.sortProperty]);
                                } else {
                                    return item[options.sortProperty];
                                }
                            });
                            if (options.sortDirection === 'desc') {
                                items.reverse();
                            }
                        }
                        return items;
                    };
                    var dataSource = function dataSource(options, callback) {
                        var items = dataFilter(options);
                        var responseData = {
                            count: items.length,
                            items: [],
                            page: options.pageIndex,
                            pages: Math.ceil(items.length / (options.pageSize || 50))
                        };
                        var firstItem, lastItem;
                        firstItem = options.pageIndex * (options.pageSize || 50);
                        lastItem = firstItem + (options.pageSize || 50);
                        lastItem = (lastItem <= responseData.count) ? lastItem : responseData.count;
                        responseData.start = firstItem + 1;
                        responseData.end = lastItem;
                        if (options.view === 'thumbnail') {
                            for (var i = firstItem; i < lastItem; i++) {
                                responseData.items.push({
                                    color: colors[items[i].type.split(', ')[0]],
                                    name: items[i].name,
                                    src: items[i].ThumbnailImage
                                });
                            }
                        } else {//default to 'list'
                            responseData.columns = columns;
                            for (var i = firstItem; i < lastItem; i++) {
                                responseData.items.push(items[i]);
                            }
                        }
//use setTimeout to simulate server response delay. In production, you would not want to do this
                        callback(responseData);
                        $('#myRepeater td a:has(img)').css('text-decoration', 'none');
                    };
                    $('#myRepeater').repeater({dataSource: dataSource});

                </script>
                <?php $this->stop() ?>
            <?php endif; ?>

        </div>

    </div>
</div>
