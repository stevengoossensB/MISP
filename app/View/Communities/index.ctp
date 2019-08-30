<?php
    echo '<div class="index">';
    echo $this->element('/genericElements/IndexTable/index_table', array(
        'data' => array(
            'data' => $community_list,
            'top_bar' => array(
                'children' => array(
                    array(
                        'type' => 'simple',
                        'children' => array(
                            array(
                                'active' => $context === 'vetted',
                                'url' => $baseurl . '/communities/index/context:vetted',
                                'text' => __('Vetted by the MISP-project team'),
                            ),
                            array(
                                'active' => $context === 'unvetted',
                                'url' => $baseurl . '/communities/index/context:unvetted',
                                'text' => __('Unvetted'),
                            )
                        )
                    ),
                    array(
                        'type' => 'search',
                        'button' => __('Filter'),
                        'placeholder' => __('Enter value to search'),
                        'data' => '',
                        'searchKey' => 'value'
                    )
                )
            ),
            'fields' => array(
                array(
                    'name' => __('Id'),
                    'sort' => 'id',
                    'class' => 'short',
                    'data_path' => 'id',
                ),
                array(
                    'name' => __('Vetted'),
                    'element' => 'boolean',
                    'class' => 'short',
                    'data_path' => 'misp_project_vetted',
                ),
                array(
                    'name' => __('Host org'),
                    'sort' => 'org_name',
                    'class' => 'short',
                    'element' => 'org',
                    'data_path' => 'Org',
                ),
                array(
                    'name' => __('Community name'),
                    'sort' => 'community_name',
                    'class' => 'short',
                    'data_path' => 'community_name',
                ),
                array(
                    'name' => __('Description'),
                    'data_path' => 'description',
                )
            ),
            'title' => __('Communities index'),
            'description' => __('You can find a list of communities below that chose to advertise their existence to the general MISP user-base. Requesting access to any of those communities is of course no guarantee of being permitted access, it is only meant to simplify the means of finding the various communities that one may be eligible for. Get in touch with the MISP project maintainers if you would like your community to be included in the list.'),
            'actions' => array(
                array(
                    'url' => '/communities/view',
                    'url_params_data_paths' => array(
                        'community_uuid'
                    ),
                    'icon' => 'eye'
                ),
                array(
                    'url' => '/communities/requestAccess',
                    'url_params_data_paths' => array(
                        'community_uuid'
                    ),
                    'icon' => 'comments'
                )
            )
        )
    ));
    echo '</div>';
    echo $this->element('/genericElements/SideMenu/side_menu', array('menuList' => 'sync', 'menuItem' => 'list_communities'));
?>
<script type="text/javascript">
    var passedArgsArray = <?php echo $passedArgs; ?>;
    if (passedArgsArray['context'] === undefined) {
        passedArgsArray['context'] = 'pending';
    }
    $(document).ready(function() {
        $('#quickFilterButton').click(function() {
            runIndexQuickFilter('/context:' + passedArgsArray['context']);
        });
        $('#quickFilterField').on('keypress', function (e) {
            if(e.which === 13) {
                runIndexQuickFilter('/context:' + passedArgsArray['context']);
            }
        });
    });
</script>