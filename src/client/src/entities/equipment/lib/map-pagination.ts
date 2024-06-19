import type { PaginationMeta } from '~/shared/api/types';
import type { Pagination } from '../model/types';

export const mapPagination = (metaDto: PaginationMeta): Pagination => {
    return {
        currentPage: metaDto.current_page,
        from: metaDto.from,
        lastPage: metaDto.last_page,
        perPage: metaDto.per_page,
        to: metaDto.to,
        total: metaDto.total
    }
}